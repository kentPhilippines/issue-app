<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuesComments extends Model
{
    use HasFactory;
    protected $table = 'issues_comments';
    protected $fillable = [
        'issue',
    ];
}
