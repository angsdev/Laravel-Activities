<?php

namespace App\Models\Activity;

use App\Traits\ModelHelpers;
use App\Models\Activity\Source;
use App\Models\Activity\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Identifier extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'ActivityIdentifiers';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'activity_id',
    'source_id',
    'value',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'activity_id',
    'source_id',
    'pivot',
  ];

  /**
   * The relations to eager load on every query.
   *
   * @var array
   */
  protected $with = [
    'source',
  ];

  /**
   * Get activity associated with the activity identifier code.
   *
   * @return belongsTo
   */
  public function activity(){

    return $this->belongsTo(Activity::class);
  }

  /**
   * Get source associated with the activity identifier code.
   *
   * @return belongsTo
   */
  public function source(){

    return $this->belongsTo(Source::class);
  }
}
