<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Models\Activity\Type;
use App\Models\Activity\Activity;
use App\Http\Controllers\ApiController;

class ActivityTypeController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'type_id' => 'exists:ActivityTypes,id|integer|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Activity::class);
    $this->authorizeResource(Type::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function index(Activity $activity){

    return $this->successResponse($activity->type);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Type  $type
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Activity $activity){

    $input = $request->validate($this->rules);
    $activity->update($input);
    $activity->load('type');
    return $this->successResponse($activity);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Type  $type
   * @return \Illuminate\Http\Response
   */
  public function destroy(Activity $activity){

    $activity->update(['type_id' => null]);
    $activity->load('type');
    return $this->successResponse($activity);
  }
}
