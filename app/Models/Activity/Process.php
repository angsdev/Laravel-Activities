<?php

namespace App\Models\Activity;

use App\Traits\ModelHelpers;
use App\Models\Activity\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Process extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'ActivityProcesses';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'description'
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
   * Get activity associated with the activity process.
   *
   * @return hasMany
   */
  public function activities(){

    return $this->hasMany(Activity::class);
  }
}
