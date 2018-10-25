<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * Override Eloquent default primary key properties
     */
    protected $primaryKey = 'offer_id';

    /**
     * Override Eloquent default primary key properties
     */
    public $incrementing = false;

    /**
     * Get the offer by offer_id
     *
     * @param  integer $offer_id
     *
     * @return object
     */
    public static function findByOfferId($offer_id)
    {
        return self::where('offer_id', $offer_id)->first();
    }
}
