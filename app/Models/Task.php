<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'description',
        'due_date',
    ];

    // Optional: Cast due_date to Carbon instance
    protected $casts = [
        'due_date' => 'date',
    ];
}
