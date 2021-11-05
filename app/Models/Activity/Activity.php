<?php

namespace App\Models\Activity;

use App\Models\User;
use App\Models\Image;
use App\Traits\ModelHelpers;
use App\Models\Activity\Type;
use App\Models\Activity\Process;
use App\Models\Activity\Attention;
use App\Models\Activity\Identifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Activities';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'type_id',
    'attention_id',
    'process_id',
    'description'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'type_id',
    'attention_id',
    'process_id',
    'pivot',
  ];

  /**
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = [
    'images',
    'type',
    'attention',
    'process',
    'identifiers',
  ];

  /**
   * Get users associated with the activity.
   *
   * @return belongsToMany
   */
  public function users(){

    return $this->belongsToMany(User::class, 'UserHasActivities');
  }

  /**
   * Get images associated with the activity.
   *
   * @return belongsToMany
   */
  public function images(){

    return $this->belongsToMany(Image::class, 'ActivityHasImages');
  }

  /**
   * Get type associated with the activity.
   *
   * @return belongsTo
   */
  public function type(){

    return $this->belongsTo(Type::class);
  }

  /**
   * Get attention associated with the activity.
   *
   * @return belongsTo
   */
  public function attention(){

    return $this->belongsTo(Attention::class);
  }

  /**
   * Get process associated with the activity.
   *
   * @return belongsTo
   */
  public function process(){

    return $this->belongsTo(Process::class);
  }

  /**
   * Get identifiers associated with the activity.
   *
   * @return hasMany
   */
  public function identifiers(){

    return $this->hasMany(Identifier::class);
  }
}
