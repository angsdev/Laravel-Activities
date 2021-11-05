<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Models\Activity\Process;
use App\Models\Activity\Activity;
use App\Http\Controllers\ApiController;

class ActivityProcessController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'process_id' => 'exists:ActivityProcesses,id|integer|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Activity::class);
    $this->authorizeResource(Process::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function index(Activity $activity){

    return $this->successResponse($activity->process);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Process  $process
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Activity $activity){

    $input = $request->validate($this->rules);
    $activity->update($input);
    $activity->load('process');
    return $this->successResponse($activity);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Process  $process
   * @return \Illuminate\Http\Response
   */
  public function destroy(Activity $activity, Process $process){

    $activity->update([ 'process_id' => null ]);
    $activity->load('process');
    return $this->successResponse($activity);
  }
}
