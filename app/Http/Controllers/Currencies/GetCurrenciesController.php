<?php

namespace App\Http\Controllers\Currencies;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use Hoyvoy\Shared\Domain\Bus\Query\QueryBus;
use Hoyvoy\Currencies\Application\Get\GetCurrenciesQuery;

final class GetCurrenciesController extends ApiController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(): JsonResponse
    {
        $currencies = $this->queryBus->ask(new GetCurrenciesQuery());

        return new JsonResponse([
            'data' => $currencies,
        ], JsonResponse::HTTP_OK);
    }
}
