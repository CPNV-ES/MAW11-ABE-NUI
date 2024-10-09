<?php

namespace App\Models;

class Fulfillments extends Model
{
    public static function saveFulfillments()
    {
        $date = date("Y-m-d H:i:s");

        parent::insert(["fulfillment"], ["fulfillment" => $date]);
    }
}
