<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exchange_rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency',
        'rate',
        'date'
    ];


    /**
     * Function for finding rates before the given rate
     *
     * @param $rate
     * @return array|mixed
     */
    public static function findRelatedRates($rate){
        // Gets the related rates before the given rate date
        $ratesArray = self::where('currency', $rate['currency'])
                            ->where('date', '<', $rate['date'])
                            ->orderBy('id', 'ASC')
                            ->get()
                            ->toArray();
        // Sets the first found rate at the start of array
        array_push($ratesArray , $rate);
        // Returns the array of data
        return $ratesArray;

    }
}

