<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RssController extends Controller
{
    /**
     * Route /
     * Gets the exchange rate data for view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rates = ExchangeRate::orderBy('id', 'DESC')->paginate(env('ITEMS_PER_PAGE', '20'));

        return view('index', compact('rates'));
    }

}
