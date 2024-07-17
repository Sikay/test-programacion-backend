<?php

namespace App\Http\Controllers\Currencies;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Hoyvoy\Shared\Domain\Bus\Query\QueryBus;
use Hoyvoy\Currencies\Application\RateConversion\GetRateConversionCurrenciesQuery;

class GetRateConversionCurrenciesController extends ApiController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $amount = $request->get('amount');

        if (empty($from) || empty($to) || empty($amount)) {
            return new JsonResponse([
                'error' => 'The fields from, to and amount are required',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $rateConversionCurrency = $this->queryBus->ask(
            new GetRateConversionCurrenciesQuery(
                $from,
                $to,
                $amount
            )
        );

        return new JsonResponse([
            'data' => $rateConversionCurrency,
        ], JsonResponse::HTTP_OK);
    }
}
