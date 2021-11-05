<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Image;
use App\Models\Permission;
use App\Traits\RoleHelpers;
use App\Traits\UserHelpers;
use App\Traits\PermissionHelpers;
use App\Models\Activity\Activity;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @OA\Schema(
 * required={"id", "username", "email", "password"},
 * @OA\Xml(name="user"),
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="firstName", type="string", maxLength=32, example="John"),
 * @OA\Property(property="lastName", type="string", maxLength=32, example="Doe"),
 * @OA\Property(property="username", type="string", maxLength=30, example="username1234"),
 * @OA\Property(property="email", type="string", format="email", description="User unique email address", example="user@gmail.com"),
 * @OA\Property(property="password", type="string", maxLength=60, description="User password", example="user@gmail.com"),
 * @OA\Property(property="api_token", type="string", maxLength=100, description="User JWT", example="user@gmail.com"),
 * @OA\Property(property="email_verified_at", type="string", format="date-time", description="Datetime marker of verification status", example="2019-02-25 12:59:20"),
 * @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", example="2019-02-25 12:59:20"),
 * @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", example="2019-02-25 12:59:20"),
 * )
 */

class User extends Authenticatable {

  use UserHelpers, RoleHelpers, PermissionHelpers,
      HasApiTokens, HasFactory, Notifiable;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Users';

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'remember_token' => null,
    'email_verified_at' => null,
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime'
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'firstname',
    'lastname',
    'username',
    'phone',
    'email',
    'password'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'email_verified_at',
    'pivot',
    'created_at',
    'updated_at'
  ];

  /**
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = [
    'roles',
    'permissions',
    'images'
  ];

  /**
   * Retrieve the model for a bound value.
   *
   * @param  mixed  $value
   * @param  string|null  $field
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function resolveRouteBinding($value, $field = null){

    return $this->findMatches([ 'id' => $value, 'fields' => 'id|email|phone|username' ]);
  }

  /**
   * Get roles associated with the user.
   *
   * @return belongsToMany
   */
  public function roles(){

    return $this->belongsToMany(Role::class, 'UserHasRoles');
  }

  /**
   * Get permissions associated with the user.
   *
   * @return belongsToMany
   */
  public function permissions(){

    return $this->belongsToMany(Permission::class, 'UserHasPermissions');
  }

  /**
   * Get activities associated with the user.
   *
   * @return belongsToMany
   */
  public function activities(){

    return $this->belongsToMany(Activity::class, 'UserHasActivities');
  }

  /**
   * Get images associated with the user.
   *
   * @return belongsToMany
   */
  public function images(){

    return $this->belongsToMany(Image::class, 'UserHasImages');
  }
}
