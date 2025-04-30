<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Review $review)
    {
        return $user->id === $review->user_id || $user->role === 'admin';
    }
    
    public function delete(User $user, Review $review)
    {
        return $user->id === $review->user_id || $user->role === 'admin';
    }
    
}
