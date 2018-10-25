<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\ProductService;

class UpdateCatalog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the database from remote API. Make GET request to markethot.ru and parse response.';

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
        $response = file_get_contents('https://markethot.ru/export/bestsp');
        ProductService::updateProducts($response);
    }
}
