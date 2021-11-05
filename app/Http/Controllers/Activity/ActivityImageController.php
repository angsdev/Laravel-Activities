<?php

namespace App\Http\Controllers\Activity;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Activity\Activity;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class ActivityImageController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'image' => 'sometimes|image|required',
    'name' => 'sometimes|unique:Images|required',
    'description' => 'sometimes|string|nullable'
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Activity::class);
    $this->authorizeResource(Image::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @return \Illuminate\Http\Response
   */
  public function index(Activity $activity){

    return $this->successResponse($activity->images);
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
    $fileName = Str::slug(now()).'.'.$input['image']->guessExtension();
    $input['name'] = (!empty($input['name'])) ? Str::slug($input['name']) : $fileName;
    $input['path'] = $input['image']->storePubliclyAs('images/activities', $fileName, 'public');

    $image = $activity->images()->create($input);
    return $this->successResponse($image);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function show(Activity $activity, Image $image){

    $activity->isAssociatedWith($image);
    return $this->successResponse($image);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Activity $activity, Image $image){

    $activity->isAssociatedWith($image);
    $image->customUpdate($this->rules);
    $activity->load('images');
    return $this->successResponse($activity);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Activity\Activity  $activity
   * @param  \App\Models\Activity\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function destroy(Activity $activity, Image $image){

    $activity->isAssociatedWith($image);
    $image->delete();
    $image->resetAutoIncrement();
    Storage::disk('public')->delete($image->path);
    $activity->load('images');
    return $this->successResponse($activity);
  }
}
