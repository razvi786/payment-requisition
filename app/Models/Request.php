<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'description',
        'invoice',
        'prf',
        'feedback',
        'raised_by',
        'raised_to',
        'status',

    ];

    /**
     * Get the user by whom the request is raised..
     */
    public function raisedBy()
    {
        return $this->belongsTo(User::class, 'raised_by', 'id');
    }

    /**
     * Get the user to whom the request is raised.
     */
    public function raisedTo()
    {
        return $this->belongsTo(User::class, 'raised_to', 'id');
    }

    /**
     * Get the statuses array
     */
    public static function getStatuses()
    {
        return Status::collect();
    }
}
