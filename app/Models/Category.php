<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'note', 'color'];
    use SoftDeletes;

    public function descriptions()
    {
        return $this->belongsToMany(Description::class, 'descriptions_categories', 'description_id', 'category_id');
    }
}
