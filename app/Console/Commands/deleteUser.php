<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class deleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-user {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $user = User::find($id);
        if($user){
            $user->delete();
            $this->info('user deleted succesfuly');
        }else{
            $this->info('user not found');
        }
    }
}
