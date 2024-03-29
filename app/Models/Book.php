<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Library;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'isbn', 'plot'];

    public function users()
    {
        return $this->belongsToMany(User::class)->using(Library::class);
    }
}
