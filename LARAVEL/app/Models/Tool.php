<?php

namespace App\Models;

use App\Observers\ToolObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ToolObserver::class])]
class Tool extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description',
        'link', 'slug', 'image'
    ];
}
