<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any image')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Image  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Image $model){

    if(($user->hasPermissionTo('view image') && $user->images->contains('id', $model->id)) ||
        $user->hasPermissionTo('view any image')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create image')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Image  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Image $model){

    if(($user->hasPermissionTo('update image') && $user->images->contains('id', $model->id)) ||
        $user->hasPermissionTo('update any image')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Image  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Image $model){

    if(($user->hasPermissionTo('delete image') && $user->images->contains('id', $model->id)) ||
        $user->hasPermissionTo('delete any image')) return true;
  }
}
