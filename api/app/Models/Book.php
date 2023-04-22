<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function students()
    {
        return $this->belongsToMany(Student::class, 'borrowings', 'book_id', 'student_id')
            ->withPivot(['id', 'borrowed_at', 'returned_at'])
            ->withTimestamps();
    }


}
