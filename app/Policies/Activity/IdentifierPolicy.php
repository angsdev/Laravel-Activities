<?php

namespace App\Policies\Activity;

use App\Models\User;
use App\Models\Activity\Identifier;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdentifierPolicy {

  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user){

    if($user->hasPermissionTo('view any activity identifier')) return true;
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Identifier  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Identifier $model){

    if(($user->hasPermissionTo('view activity identifier') &&
        $user->activities->first(fn($val) => $val->identifiers->contains('id', $model->id))) ||
        $user->hasPermissionTo('view any activity identifier')) return true;
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user){

    if($user->hasPermissionTo('create activity identifier')) return true;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Identifier  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Identifier $model){

    if(($user->hasPermissionTo('update activity identifier') &&
        $user->activities->first(fn($val) => $val->identifiers->contains('id', $model->id))) ||
        $user->hasPermissionTo('update any activity identifier')) return true;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Activity\Identifier  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Identifier $model){

    if(($user->hasPermissionTo('delete activity identifier') &&
        $user->activities->first(fn($val) => $val->identifiers->contains('id', $model->id))) ||
        $user->hasPermissionTo('delete any activity identifier')) return true;
  }
}
