<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

 
    protected $fillable = [
        'voting_pool_id',
        'answer',
        'name',
        'email',
    ];

    public function votingPool()
    {
        return $this->belongsTo(VotingPool::class);
    }
}
