<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Project extends Model
{
  use AsSource;

  /**
   * @var array
   */
  protected $fillable = [
    'name',
    'org',
    'description',
    'key',
    'start_date',
    'finish_date'
  ];
}
