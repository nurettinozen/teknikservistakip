<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class IdeHelper extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ide';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tek seferde ide-helper çağırılıyor.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(){
        $this->call('ide-helper:generate');
        $this->call('ide-helper:meta');
        $this->call('ide-helper:models', ['--nowrite' => true]);
    }
}