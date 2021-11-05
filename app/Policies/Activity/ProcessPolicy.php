<?php

namespace App\Policies\Activity;

use App\Models\User;
use App\Models\Activity\Process;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProcessPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any activity process')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Process  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Process $model){

    if(($user->hasPermissionTo('view activity identifier') &&
        $user->activities->first(fn($val) => $val->process->id === $model->id)) ||
        $user->hasPermissionTo('view any activity identifier')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create activity process')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Process  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Process $model){

    if($user->hasPermissionTo('update activity process')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Process  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Process $model){

    if($user->hasPermissionTo('delete activity process')) return true;
  }
}
