<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

  use HasUuids;
  static $rules = [
    'name' => 'required',
    'address' => 'required'
  ];

  protected $perPage = 20;

  protected $keyType = 'string';

  public $incrementing = false;

  protected $fillable = ['name', 'address'];

  public function createdBy()
  {
    return $this->hasOne(User::class, 'id', 'created_by');
  }

  public function updatedBy()
  {
    return $this->hasOne(User::class, 'id', 'updated_by');
  }
}
