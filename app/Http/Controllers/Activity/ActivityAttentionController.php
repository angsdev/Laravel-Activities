<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Models\Activity\Activity;
use App\Models\Activity\Attention;
use App\Http\Controllers\ApiController;

class ActivityAttentionController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'attention_id' => 'exists:ActivityAttentions,id|integer|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Activity::class);
    $this->authorizeResource(Attention::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function index(Activity $activity){

    return $this->successResponse($activity->attention);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Attention  $attention
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Activity $activity){

    $input = $request->validate($this->rules);
    $activity->update($input);
    $activity->load('attention');
    return $this->successResponse($activity);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Attention  $attention
   * @return \Illuminate\Http\Response
   */
  public function destroy(Activity $activity){

    $activity->update([ 'attention_id' => null ]);
    $activity->load('attention');
    return $this->successResponse($activity);
  }
}
