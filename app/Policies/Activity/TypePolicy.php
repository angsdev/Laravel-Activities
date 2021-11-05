<?php

namespace App\Policies\Activity;

use App\Models\User;
use App\Models\Activity\Type;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypePolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any activity type')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Type  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Type $model){

    if(($user->hasPermissionTo('view activity type') &&
        $user->activities->first(fn($val) => $val->type->id === $model->id)) ||
        $user->hasPermissionTo('view any activity type')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create activity type')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Type  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Type $model){

    if($user->hasPermissionTo('update activity type')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Type  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Type $model){

    if($user->hasPermissionTo('delete activity type')) return true;
  }
}
