<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Models\Activity\Activity;
use App\Models\Activity\Identifier;
use App\Http\Controllers\ApiController;

class ActivityIdentifierController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'source_id' => 'exists:ActivitySources,id|integer|required',
    'value' => 'string|required'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Activity::class);
    $this->authorizeResource(Identifier::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function index(Activity $activity){

    return $this->successResponse($activity->identifiers);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Activity $activity){

    $input = $request->validate($this->rules);
    $activity->identifiers()->create($input);
    $activity->load('identifiers');
    return $this->successResponse($activity);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Identifier  $identifier
   * @return \Illuminate\Http\Response
   */
  public function show(Activity $activity, Identifier $identifier){

    $activity->isAssociatedWith($identifier);
    return $this->successResponse($identifier);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Identifier  $identifier
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Activity $activity, Identifier $identifier){

    $activity->isAssociatedWith($identifier);
    $identifier->customUpdate($this->rules);
    $activity->load('identifiers');
    return $this->successResponse($activity);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Identifier  $identifier
   * @return \Illuminate\Http\Response
   */
  public function destroy(Activity $activity, Identifier $identifier){

    $activity->isAssociatedWith($identifier);
    $identifier->delete();
    $identifier->resetAutoIncrement();
    $activity->load('identifiers');
    return $this->successResponse($activity);
  }
}
