<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Noticias extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    public function uploads(): MorphMany
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
