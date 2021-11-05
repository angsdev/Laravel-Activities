<?php

namespace App\Models;

use App\Models\User;
use App\Traits\ModelHelpers;
use App\Models\Activity\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Images';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'description',
    'path'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'pivot',
  ];

  /**
   * Get users associated with the image.
   *
   * @return belongsToMany
   */
  public function users(){

    return $this->belongsToMany(User::class, 'UserHasImages');
  }

  /**
   * Get activities associated with the image.
   *
   * @return belongsToMany
   */
  public function activities(){

    return $this->belongsToMany(Activity::class, 'ActivityHasImages');
  }
}
