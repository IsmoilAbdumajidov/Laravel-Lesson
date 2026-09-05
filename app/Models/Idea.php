<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Idea extends Model
{
    protected $guarded=[];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

// protected $guarded = []; Laravel'da mass assignmentni boshqaradi.
// Laravelga: “Modeldagi istalgan field ni create() yoki update() orqali to‘ldirishga ruxsat ber”
