<?php

namespace App\Http\Helpers;

use App\Models\ExchangeRate;

class RssFeedHelper
{
    /**
     * Function that imports and prepares data for saving
     *
     * @return bool
     */

    public function importAndPrepareExchangeRates()
    {
        // Load xml string so that cdata is visible
        $feed = simplexml_load_file(env('RSS_FEED', "https://www.bank.lv/vk/ecb_rss.xml"), null, LIBXML_NOCDATA);
        //If data available
        if ($feed != false) {
            $arrayOfItems = [];
            $counter = 0;
            // Loops the rss feed and gets date and rate exchanges aas a string
            foreach ($feed->channel->item as $item) {
                $arrayOfItems[$counter]['desc'] = $item->description[0];
                $arrayOfItems[$counter]['date'] = $item->pubDate[0];
                $counter++;
            }
            //Checks if array of data not empty only then continues
            if (!empty($arrayOfItems)) {
                // Loops the data array to "beautify" data for saving
                foreach ($arrayOfItems as &$item) {
                    // pregmatch finds the rate in the string of rates
                    // 3 capital letters + space + numbers + dot + numbers
                    preg_match_all("/([A-Z]{3}\s(\d+.\d+))/", $item['desc'], $matches);
                    // Set the matched items into array
                    $item['desc'] = $matches[0];
                    // Loops the found mathed items and set exchange_rate in array where
                    // key = name of currency
                    // value = rate
                    foreach ($item['desc'] as $key => $match) {
                        $explodedData = explode(' ', $match);
                        unset($item['desc'][$key]);
                        $item['desc'][$explodedData[0]] = $explodedData[1];
                    }
                    // Change date format to mysql
                    $item['date'] = date('Y-m-d', strtotime($item['date']));
                }
                 return (((new self())->saveExchangeRates($arrayOfItems)) == true) ? true : false;
            }
        }
        return false;
    }

    /**
     * Gets array of prepared data and checks if data exists
     * If new exchange rate saves it
     *
     * @param $exchangeRateData
     * @return bool
     */
    public function saveExchangeRates($exchangeRateData)
    {
        //Checks if array not empty
        if (!empty($exchangeRateData)) {
            $exchangeRates = [];
            // Loops the array of data with exchange rates and saves it to db if not yet there
            foreach ($exchangeRateData as $item) {
                //Loops the currencies and rates
                foreach ($item['desc'] as $currency => $rate) {
                    // Check if rate already in system
                    $existingExchangeRate = ExchangeRate::where('currency', $currency)->where('date', $item['date'])->first();
                    if (!$existingExchangeRate) {
                        //If not found
                        $exchangeRates[] = [
                            'currency' => $currency,
                            'rate' => $rate,
                            'date' => $item['date'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                }
            }
            if (!empty($exchangeRates)) {
                return (ExchangeRate::insert($exchangeRates) == true) ? true : false; // Bulk create data
            }
        }
        return false;
    }
}
