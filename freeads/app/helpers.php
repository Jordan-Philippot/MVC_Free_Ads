<?php


function getBuyerName($buyer)
{
    $user = App\User::find($buyer);
    return $user->name;
}
function getBuyerId($buyer)
{
    $buyer = App\Message::find($buyer);
    return $buyer->buyer;
}
function getAd($id)
{
    $id = App\Ad::find($id);
    return $id->id;
}
function getSenderId($seller)
{
    $seller = App\Message::find($seller);
    return $seller->seller;
}
