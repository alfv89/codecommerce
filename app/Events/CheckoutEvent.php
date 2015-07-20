<?php

namespace CodeCommerce\Events;

use CodeCommerce\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CheckoutEvent extends Event
{
    use SerializesModels;
    private $user;
    private $order;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $order
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
