<?php

namespace App\Console\Commands;

use App\Mail\BirthDayMail;
use Illuminate\Console\Command;
use App\Repositories\UserRepositories;
use Illuminate\Support\Facades\Mail;

class AutoBirthDayMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:birthdayMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepositories $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = $this->userRepository->getBirthday();

        if ($users->count() > 0) {
            foreach ($users as $user) {
                Mail::to($user)->send(new BirthDayMail($user));
            }
        }

        return 0;
    }
}
