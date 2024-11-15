<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'reports';

    protected $perPage = 25;

    protected $fillable = ['id', 'title', 'file_url', 'ext', 'download_link', 'generated_by'];

    protected $keyType = 'string';

    public $incrementing = false;

    public function generatedBy()
    {
        return $this->hasOne(User::class, 'id',  'generated_by');
    }
}
