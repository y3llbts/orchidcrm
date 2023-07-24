<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Task extends Model
{
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'project'
    ];
}
