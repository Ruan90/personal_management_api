<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DescriptionCategory extends Model
{
    use HasFactory;
    protected $fillable = ['description_id', 'category_id'];
    protected $table = 'descriptions_categories';
    use SoftDeletes;
}
