<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Activity\Activity;
use App\Http\Controllers\ApiController;

class ActivityController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'type_id' => 'sometimes|exists:ActivityTypes,id|integer|required',
    'attention_id' => 'sometimes|exists:ActivityAttentions,id|integer|required',
    'process_id' => 'sometimes|exists:ActivityProcesses,id|integer|required',
    'source_id' => 'sometimes|exists:ActivitySources,id|integer|required',
    'identifier' => 'sometimes|required',
    'description' => 'sometimes|string|required',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Activity::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Activity::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $input['value'] = Arr::pull($input, 'identifier');
    $activity = Activity::create($input);
    $activity->identifiers()->create($input);
    $activity->load('type', 'attention', 'process', 'identifiers');
    return $this->successResponse($activity, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function show(Activity $activity){

    return $this->successResponse($activity);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Activity $activity){

    $activity->customUpdate($this->rules);
    [ 'source_id' => $source, 'identifier' => $value ] = $request->all();
    if(!empty($source)) $activity->identifiers()->update(['source_id' => $source, 'value' => $value]);
    $activity->load(['type', 'attention', 'process', 'identifiers']);
    return $this->successResponse($activity);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function destroy(Activity $activity){

    $activity->delete();
    $activity->resetAutoIncrement();
    return $this->successResponse($activity);
  }
}
