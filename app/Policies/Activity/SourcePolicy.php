<?php

namespace App\Policies\Activity;

use App\Models\User;
use App\Models\Activity\Source;
use Illuminate\Auth\Access\HandlesAuthorization;

class SourcePolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any activity source')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Source  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Source $model){

    if(($user->hasPermissionTo('view activity source') &&
        $user->activities->first(fn($val) => $val->source->id === $model->id)) ||
        $user->hasPermissionTo('view any activity source')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create activity source')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Source  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Source $model){

    if($user->hasPermissionTo('update activity source')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Source  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Source $model){

    if($user->hasPermissionTo('delete activity source')) return true;
  }
}
