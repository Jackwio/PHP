<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CurrencyController extends Controller
{

    public array $currencies;

    public function __construct()
    {
        $this->currencies = [
            new Currency("USD", "2023-12-25T12:00:00Z", new Rate(1.0000, 31.5000, 148.5000)),
            new Currency("TWD", "2023-12-25T12:00:00Z", new Rate(0.0317, 1.0000, 4.7143)),
            new Currency("JPY", "2023-12-25T12:00:00Z", new Rate(0.00673, 0.2121, 1.0000))
        ];
    }
    
    /**
     * Exchange rate
    */
    public function exchange(Request $request): JsonResponse
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'Invalid JSON request'], 400);
        }

        $from_currency = $request->json('from_currency');
        $to_currency = $request->json('to_currency');
        $amount = $request->json('amount');

        $result = array_filter($this->currencies, fn($currency) => $currency->base_currency === $from_currency);
        if(count($result) == 0){
            throw new HttpResponseException(response()->json(['error' => 'Currency not found'], 404));
        }

        if($result[0]->rate->$to_currency === null){
            throw new HttpResponseException(response()->json(['error' => 'Currency not found'], 404));
        }
        $rate = $result[0]->rate->$to_currency;

        return response()->json([
            'from_currency' => $from_currency,
            'to_currency' => $to_currency,
            'amount' => $amount,
            'converted_amount' => $rate * $amount,
            'rate' => $rate
        ]);
    }
}
