<?php

namespace App\Console\Commands\Currencies;

use Illuminate\Console\Command;
use Hoyvoy\Shared\Domain\Bus\Command\CommandBus;
use Hoyvoy\Currencies\Application\Update\UpdateRateConversionCurrenciesCommand as UpdateRateConversionCommand;

class UpdateRateConversionCurrenciesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:update-rate-conversion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to update rate conversion currencies';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $command = new UpdateRateConversionCommand();
        app(CommandBus::class)->dispatch($command);
        return self::SUCCESS;
    }
}
