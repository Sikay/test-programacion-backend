<?php

namespace Tests\Currencies\Application\Update;

use Tests\TestCase;
use Hoyvoy\Shared\Domain\Bus\Event\EventBus;
use Hoyvoy\Currencies\Domain\Entity\Currency;
use Hoyvoy\Currencies\Domain\Collection\Currencies;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyModel;
use Hoyvoy\Currencies\Infrastructure\Eloquent\CurrencyRepository;
use Hoyvoy\Currencies\Domain\Service\CurrencyRateUpdater;
use Tests\Currencies\Infrastructure\Repository\CurrencyapiRepositoryFake;
use Hoyvoy\Currencies\Application\Update\UpdateRateConversionCurrenciesCommand;
use Hoyvoy\Currencies\Domain\Interface\CurrencyRateConversionRepositoryInterface;
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

        $eventBus = $this->createMock(EventBus::class);
        $eventBus->expects(self::once())->method('publish');

        $command = new UpdateRateConversionCurrenciesCommand();
        $service = new CurrencyRateUpdater(new CurrencyapiRepositoryFake(), $currencyRepository, $eventBus);
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
