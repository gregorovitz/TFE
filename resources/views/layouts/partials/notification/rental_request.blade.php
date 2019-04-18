<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 09/04/2019
 * Time: 10:17
 */
?>
{{--<a href="/event/{{$notification->data['event']['id']}}" onclick="markNotificationAsRead({{$notification->id}})">--}}
{{--{{$notification->data['user']['name'].' '.$notification->data['user']['firstname']}} a fait une demande de location--}}
{{--</a>--}}
<a href="/markAsRead/{{$notification->id}}/{{$notification->data['event']['id']}}">
    {{$notification->data['user']['name'].' '.$notification->data['user']['firstname']}} a fait une demande de location
</a>
