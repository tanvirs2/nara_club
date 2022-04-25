<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Models\MemberLib;
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

        $uniqueMember = Member::all()->unique('name');


        try {
            foreach ($uniqueMember as $m) {
                $memberLibForInsert = new MemberLib();
                $memberLibForInsert->name = $m->name;
                $memberLibForInsert->email = $m->email;
                $memberLibForInsert->phone = $m->phone;
                $memberLibForInsert->address = $m->address;
                $memberLibForInsert->save();
            }

            foreach (Member::all() as $m2) {
                $mLib = MemberLib::where('name', $m2->name)->first();
                $m2->member_lib_id = $mLib->id;
                $m2->save();
            }
            $this->info('The command was successful!');
        } catch (\Exception $exception) {
            $this->error($exception);
        }

        //$this->info('The command was successful!');
        //return Command::SUCCESS;
        /*$this->table(
            ['Name', 'Email'],
            Member::all(['name', 'email'])->toArray()
        );*/

        //Member::
    }
}
