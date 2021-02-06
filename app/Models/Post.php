<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',

    ];
    /**
     * Get the author of the blog post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
       return $this->hasMany(Like::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unlikes()
    {
        return $this->hasMany(Unlike::class);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function likedBy(User $user)
    {
       return $this->likes->contains('user_id', $user->id);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function unLikedBy(User $user)
    {
        return $this->unlikes->contains('user_id', $user->id);
    }
}
