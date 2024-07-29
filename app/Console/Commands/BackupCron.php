<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class BackupCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:backupcron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Backup';

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
        try {

            $options = ['--disable-notifications' => true];
            // $options['--only-db'] = false;
            // $filename = date('dmY_His')."_backup";
            // $options['--filename'] = $filename.".zip";

            Artisan::call('backup:run',$options);

        } catch (Exception $exception) {
            return "";
        }
    }
}
