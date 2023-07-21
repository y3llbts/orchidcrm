<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Organization extends Model
{
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'tax_rate',
        'key',
        'user_admin'
    ];
}
