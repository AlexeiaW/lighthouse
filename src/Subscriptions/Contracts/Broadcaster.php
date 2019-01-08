<?php

namespace Nuwave\Lighthouse\Subscriptions\Contracts;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nuwave\Lighthouse\Subscriptions\Subscriber;

interface Broadcaster
{
    /**
     * Handle authorized subscription request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function authorized(Request $request);

    /**
     * Handle unauthorized subscription request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function unauthorized(Request $request);

    /**
     * Handle subscription web hook.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function hook(Request $request);

    /**
     * Send data to subscriber.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  mixed[]    $data
     */
    public function broadcast(Subscriber $subscriber, array $data);
}
