<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'reference_id', 'author_id'];
    use SoftDeletes;

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'descriptions_categories', 'description_id', 'category_id');
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }
}
