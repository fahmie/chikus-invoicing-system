<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class CleanOldBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CleanOldBackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Cleaning up old backups';

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
            Artisan::call('backup:clean',$options);

        } catch (Exception $exception) {
            return "";
        }
    }
}
