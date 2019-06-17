<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 17/06/2019
 * Time: 22:22
 */
?>
<a href="/markAsRead/{{$notification->id}}/{{$notification->data['event']['id']}}">
la réservation ayant la communication n° {{$notification->data['booking']['communication']}}à été validée et est en attente de payement.
</a>