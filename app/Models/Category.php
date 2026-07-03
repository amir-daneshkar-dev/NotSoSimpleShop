<?php

namespace App\Models;

use App\Traits\HasSlug;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
    ];
}
