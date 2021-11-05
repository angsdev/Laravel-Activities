<?php

namespace App\Http\Controllers\Activity\Attention;

use Illuminate\Http\Request;
use App\Models\Activity\Attention;
use App\Http\Controllers\ApiController;

class AttentionController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'name' => 'sometimes|unique:ActivityAttentions|string|required',
    'description' => 'sometimes|string|nullable'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Attention::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Attention::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $attention = Attention::create($input);
    return $this->successResponse($attention, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity\Attention  $attention
   * @return \Illuminate\Http\Response
   */
  public function show(Attention $attention){

    return $this->successResponse($attention);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Attention  $attention
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Attention $attention){

    $attention->customUpdate($this->rules);
    return $this->successResponse($attention);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Attention  $attention
   * @return \Illuminate\Http\Response
   */
  public function destroy(Attention $attention){

    $attention->delete();
    $attention->resetAutoIncrement();
    return $this->successResponse($attention);
  }
}
