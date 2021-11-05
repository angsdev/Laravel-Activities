<?php

namespace App\Policies\Activity;

use App\Models\User;
use App\Models\Activity\Attention;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttentionPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any activity attention')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Attention  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Attention $model){

    if(($user->hasPermissionTo('view activity attention') &&
        $user->activities->first(fn($val) => $val->attention->id === $model->id)) ||
        $user->hasPermissionTo('view any activity attention')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create activity attention')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Attention  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Attention $model){

    if($user->hasPermissionTo('update activity attention')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Attention  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Attention $model){

    if($user->hasPermissionTo('delete activity attention')) return true;
  }
}
