<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowings', 'student_id', 'book_id')
            ->withPivot(['id', 'borrowed_at', 'returned_at'])
            ->withTimestamps();
    }
}
