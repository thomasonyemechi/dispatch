<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Minishlink\WebPush\WebPush;

class SendOrderStatusListener
{
    /**
     * Create the event listener.
     */
    public function __construct(WebPush $webPush)
    {
        $this->webPush = $webPush;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderStatusChanged $event): void
    {
        $order = $event->order;
        $newStatus = $event->newStatus;

        // Retrieve the user's WebPush subscriptions, e.g., from the order's customer
        $subscriptions = $order->customer->webPushSubscriptions;

        $notificationData = [
            'title' => 'Order Status Update',
            'body' => "Your order (ID: $order->id) status is now $newStatus.",
        ];
        foreach ($subscriptions as $subscription) {
            $this->webPush->sendNotification($subscription, json_encode($notificationData));
        }
    }
}
