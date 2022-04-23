<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MemberSaveToMemberLib extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'helper:MemberToMemberLib';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Member Save To MemberLib';

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
        return Command::SUCCESS;
    }
}
