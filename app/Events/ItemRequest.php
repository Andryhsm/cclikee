<?php

namespace App\Events;
use App\User;
use Illuminate\Queue\SerializesModels;
class ItemRequest extends Event
{
    use SerializesModels;
    public $user;
    /**
     * Create a new event instance.
     *
     * @param  Customer $customer
     * @param  $password_needs_to_set
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }
}
