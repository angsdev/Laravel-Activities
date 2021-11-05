<?php

namespace App\Http\Controllers\Activity\Type;

use Illuminate\Http\Request;
use App\Models\Activity\Type;
use App\Http\Controllers\ApiController;

class TypeController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'name' => 'sometimes|unique:ActivityTypes|string|required',
    'description' => 'sometimes|string|nullable'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Type::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Type::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $type = Type::create($input);
    return $this->successResponse($type, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity\Type  $type
   * @return \Illuminate\Http\Response
   */
  public function show(Type $type){

    return $this->successResponse($type);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Type  $type
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Type $type){

    $type->customUpdate($this->rules);
    return $this->successResponse($type);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Type  $type
   * @return \Illuminate\Http\Response
   */
  public function destroy(Type $type){

    $type->delete();
    $type->resetAutoIncrement();
    return $this->successResponse($type);
  }
}
