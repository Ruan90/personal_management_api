<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'note'];
    use SoftDeletes;

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }

    public function descriptions()
    {
        return $this->belongsToMany(Description::class);
    }
}
