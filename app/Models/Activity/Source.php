<?php

namespace App\Models\Activity;

use App\Traits\ModelHelpers;
use App\Models\Activity\Identifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model {

  use ModelHelpers, HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'ActivitySources';

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
   * Get identifiers associated with the activity source.
   *
   * @return hasMany
   */
  public function identifiers(){

    return $this->hasMany(Identifier::class);
  }
}
