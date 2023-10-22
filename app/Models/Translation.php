<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    use HasFactory, SoftDeletes;

    const DEFAULT_LANGUAGE = 'en';

    protected $table = 'translations';

    protected $fillable = [
        'airport_id',
        'language',
        'text',
    ];

    protected $hidden = ['deleted_at'];


    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }
}
