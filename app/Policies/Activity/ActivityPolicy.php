<?php

namespace App\Policies\Activity;

use App\Models\User;
use App\Models\Activity\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any activity')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Activity  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Activity $model){

    if(($user->hasPermissionTo('view activity') && $user->activities->contains('id', $model->id)) ||
        $user->hasPermissionTo('view any activity')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create activity')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Activity  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Activity $model){

    if(($user->hasPermissionTo('update activity') && $user->activities->contains('id', $model->id)) ||
        $user->hasPermissionTo('update any activity')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Activity  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Activity $model){

    if(($user->hasPermissionTo('delete activity') && $user->activities->contains('id', $model->id)) ||
        $user->hasPermissionTo('delete any activity')) return true;
  }
}
