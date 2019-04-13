<?php


namespace App\Console\Commands;


use App\Models\Currency;
use GuzzleHttp\Client;

class CurrencyRate
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Currency Rate From Currency Layer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url            = "http://apilayer.net/api/live?access_key=" . env('CURRENCY_LAYER');
        $client         = new Client();
        $response       = $client->get($url);

        $response       = json_decode($client->get($url)->getBody(), true);

        foreach ($response['quotes'] as $key => $value){
            $currency            = Currency::updateOrCreate([
                'name'  => ltrim($key, 'USD'),
                'rate'  => $value,
            ]);
        }
        $this->info("Task completed! Currency Rate Fetched");
    }

}
