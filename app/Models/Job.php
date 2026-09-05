<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;



// class Job extends Model{
//     protected $table = "job_listings";

//     protected $fillable = ['title','salary'];

// }

class Job
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50.000',
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$20.000',
            ],
            [
                'id' => 3,
                'title' => 'Project Manager',
                'salary' => '$15.000',
            ],
        ];
    }

    public static function find(int $id): array
    {
        $job = Arr::first(static::all(), fn ($job) => $job['id'] == $id);
        if (!$job) {
          abort(404);
        }
        return $job;
        // static::all() same (this) key word in js
    }
}
