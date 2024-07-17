<?php

namespace Tests\Currencies\Application\Update;

use Tests\TestCase;
use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyModel;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyRepository;
use Hoyvoy\Currencies\Domain\Service\CurrencyRateConversionUpdater;
use Tests\Currencies\Infrastructure\Repository\CurrencyapiRepositoryFake;
use Hoyvoy\Currencies\Application\Update\UpdateRateConversionCurrenciesCommand;
use Hoyvoy\Currencies\Application\Update\UpdateRateConversionCurrenciesCommandHandler;

class UpdateRateConversionCurrenciesCommandHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_should_create_currencies()
    {
        $eurCurrency = CurrencyModel::factory(['code' => 'EUR'])->create();
        $usdCurrency = CurrencyModel::factory(['code' => 'USD'])->create();

        $currencyRepository = $this->createMock(CurrencyRepository::class);
        $currencyRepository->expects(self::once())->method('saveAll');

        $currencies = $this->getCurrencies($eurCurrency, $usdCurrency);
        $currencyRepository->method('findAll')->willReturn($currencies);

        $command = new UpdateRateConversionCurrenciesCommand();
        $service = new CurrencyRateConversionUpdater(new CurrencyapiRepositoryFake(), $currencyRepository);
        $handler = new UpdateRateConversionCurrenciesCommandHandler($service);

        $handler->__invoke($command);
        $this->assertTrue(true);
    }

    private function getCurrencies(CurrencyModel $eurCurrency, CurrencyModel $usdCurrency): Currencies
    {
        return new Currencies([
            Currency::fromPrimitives(
                $eurCurrency->id,
                $eurCurrency->name,
                $eurCurrency->code,
                $eurCurrency->rate_usd
            ),
            Currency::fromPrimitives(
                $usdCurrency->id,
                $usdCurrency->name,
                $usdCurrency->code,
                $usdCurrency->rate_usd
            ),
        ]);
    }
}
