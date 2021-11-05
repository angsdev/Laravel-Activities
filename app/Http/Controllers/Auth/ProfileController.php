<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProfileController extends ApiController {

  /**
   * Get user profile info.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){

    $user = $request->user()->load(
      'roles', 'roles.permissions', 'permissions', 'images',
      'activities', 'activities.type', 'activities.identifier',
      'activities.attention', 'activities.process', 'activities.images'
    );
    return $this->successResponse($user);
  }

  /**
   * Get user profile roles.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function roles(Request $request){

    $roles = $request->user()->roles->load('permissions');
    return $this->successResponse($roles);
  }

  /**
   * Get user profile permissions.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function permissions(Request $request){

    $permissions = $request->user()->permissions;
    return $this->successResponse($permissions);
  }

  /**
   * Get user profile images.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function images(Request $request){

    $images = $request->user()->images;
    return $this->successResponse($images);
  }

  /**
   * Get user profile activities.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function activities(Request $request){

    $activities = $request->user()->activities->load('type', 'identifiers', 'identifiers.source', 'attention', 'process');
    return $this->successResponse($activities);
  }
}
