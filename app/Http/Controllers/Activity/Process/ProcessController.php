<?php

namespace App\Http\Controllers\Activity\Process;

use Illuminate\Http\Request;
use App\Models\Activity\Process;
use App\Http\Controllers\ApiController;

class ProcessController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'name' => 'sometimes|unique:ActivityProcesses|string|required',
    'description' => 'sometimes|string|nullable'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Process::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Process::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $process = Process::create($input);
    return $this->successResponse($process, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity\Process  $process
   * @return \Illuminate\Http\Response
   */
  public function show(Process $process){

    return $this->successResponse($process);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Process  $process
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Process $process){

    $process->customUpdate($this->rules);
    return $this->successResponse($process);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Process  $process
   * @return \Illuminate\Http\Response
   */
  public function destroy(Process $process){

    $process->delete();
    $process->resetAutoIncrement();
    return $this->successResponse($process);
  }
}
