<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'airports';

    protected $fillable = [
        'name',
        'iata_code',
        'latitude',
        'longitude',
        'description',
        'terms_and_conditions',
    ];

    protected $hidden = ['deleted_at'];

    public function translations()
    {
        return $this->hasMany(Translation::class, 'airport_id');
    }
}
