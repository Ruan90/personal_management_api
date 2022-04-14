<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reference extends Model
{
    use HasFactory;
    protected $fillable = ['source', 'author_id'];
    use SoftDeletes;

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function description()
    {
        return $this->belongsToMany(Description::class);
    }
}
