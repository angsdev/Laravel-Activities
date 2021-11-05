<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class UserImageController extends ApiController {

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

    $this->authorizeResource(User::class);
    $this->authorizeResource(Image::class);
  }

  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function index(User $user){

    return $this->successResponse($user->images);
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
    $fileName = Str::slug(now()).'.'.$input['image']->guessExtension();
    $input['name'] = (!empty($input['name'])) ? Str::slug($input['name']) : $fileName;
    $input['path'] = $input['image']->storePubliclyAs('images/users', $fileName, 'public');

    $image = $user->images()->create($input);
    return $this->successResponse($image);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function show(User $user, Image $image){

    $user->isAssociatedWith($image);
    return $this->successResponse($image);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @param  \App\Models\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user, Image $image){

    $user->isAssociatedWith($image);
    $image->customUpdate($this->rules);
    $user->load('images');
    return $this->successResponse($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Image  $image
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user, Image $image){

    $user->isAssociatedWith($image);
    $image->delete();
    $image->resetAutoIncrement();
    Storage::disk('public')->delete($image->path);
    $user->load('images');
    return $this->successResponse($user);
  }
}
