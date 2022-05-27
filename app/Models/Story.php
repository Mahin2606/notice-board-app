<?php

namespace App\Models;

use App\Enums\StoryStatus;

use App\Mail\ApproveStoryEmail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($story) {
            try {
                $user = $story->user;
                Mail::to($user->email)->send(new ApproveStoryEmail($story));
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithApproved($query)
    {
        return $query->where('status', StoryStatus::APPROVED);
    }
}
