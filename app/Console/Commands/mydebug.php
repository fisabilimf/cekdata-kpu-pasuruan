<?php

namespace App\Console\Commands;

use App\Models\data_tms;
use App\Models\data_ubah;
use App\Models\datapemilih;
use Illuminate\Console\Command;

class mydebug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:mydebug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'nDebug';

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
     * @return int
     */
    public function handle()
    {
        echo(datapemilih::find(269)->ubah()->all());
        return 0;
    }
}
