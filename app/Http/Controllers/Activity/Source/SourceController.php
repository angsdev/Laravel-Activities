<?php

namespace App\Http\Controllers\Activity\Source;

use Illuminate\Http\Request;
use App\Models\Activity\Source;
use App\Http\Controllers\ApiController;

class SourceController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'name' => 'sometimes|unique:ActivitySources|string|required',
    'description' => 'sometimes|string|nullable'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Source::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Source::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $source = Source::create($input);
    return $this->successResponse($source, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity\Source  $source
   * @return \Illuminate\Http\Response
   */
  public function show(Source $source){

    return $this->successResponse($source);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Source  $source
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Source $source){

    $source->customUpdate($this->rules);
    return $this->successResponse($source);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Source  $source
   * @return \Illuminate\Http\Response
   */
  public function destroy(Source $source){

    $source->delete();
    $source->resetAutoIncrement();
    return $this->successResponse($source);
  }
}
