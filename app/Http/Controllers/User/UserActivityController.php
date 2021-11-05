<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Activity\Activity;
use App\Http\Controllers\ApiController;

class UserActivityController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'activity_id' => 'exists:Activities,id|integer|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(User::class);
    $this->authorizeResource(Activity::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function index(User $user){

    return $this->successResponse($user->activities);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, User $user){

    $input = $request->validate($this->rules);
    $user->activities()->sync($input, false);
    $user->load('activities');
    return $this->successResponse($user);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function show(User $user, Activity $activity){

    $user->isAssociatedWith($activity);
    return $this->successResponse($activity);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user, Activity $activity){

    $user->isAssociatedWith($activity);
    $input = $request->validate($this->rules);
    $user->activities()->sync($input);
    $user->load('activities');
    return $this->successResponse($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user, Activity $activity){

    $user->isAssociatedWith($activity)->activities()->detach($activity->id);
    $user->load('activities');
    $this->resetAutoIncrement('UserHasActivities');
    return $this->successResponse($user);
  }
}
