<?php

namespace App\Http\Controllers\Image;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class ImageController extends ApiController {

  /**
   * Validation rules.
   *
   * @var array
   */
  protected $rules = [
    'image' => 'sometimes|image|required',
    'scope' => 'string|required_with:image',
    'scope_content' => 'integer|required_with:image,scope',
    'name' => 'sometimes|unique:Images|required',
    'description' => 'sometimes|string|nullable',
  ];

  /**
   * Setup the new controller instance.
   */
  public function __construct(){

    $this->authorizeResource(Image::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){

    return $this->successResponse(Image::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){

    $input = $request->validate($this->rules);
    $subdir = 'images/'.(($input['scope'] === 'user') ? 'users' : 'activities');
    $fileName = Str::slug(now()).'.'.$input['image']->guessExtension();
    $input['name'] = (!empty($input['name'])) ? Str::slug($input['name']) : $fileName;
    $input['path'] = $input['image']->storePubliclyAs($subdir, $fileName, 'public');

    $image = Image::create($input);
    $case = [
      'user' => fn() => $image->user()->sync($input['scope_content'], false),
      'activity' => fn() => $image->activities()->sync($input['scope_content'], false)
    ];
    $case[$input['scope']]();
    return $this->successResponse($image, 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function show(Image $image){

    return $this->successResponse($image);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Image $image){

    $image->customUpdate($this->rules);
    return $this->successResponse($image);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function destroy(Image $image){

    $image->delete();
    $image->resetAutoIncrement();
    Storage::disk('public')->delete($image->path);
    return $this->successResponse($image);
  }
}
