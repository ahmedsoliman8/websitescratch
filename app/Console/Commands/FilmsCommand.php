<?php

namespace App\Console\Commands;

use App\Models\Video;
use Illuminate\Console\Command;

class FilmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'show videos title';

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
        $video=Video::all();
        $bar=$this->output->createProgressBar(count($video));
        foreach ($video as $v){
            $this->line($v->name);
            $bar->advance();
        }
        $bar->finish();


    }
}
