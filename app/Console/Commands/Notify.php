<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\NotifyEmail;
use Illuminate\Console\Command;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notify for all users every day';

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
//        $user  = User::select('email')->get();
        $emails = User::pluck('email')->toArray();
        $data   = [ 'title' => 'programming', 'body' => 'php'];
        foreach($emails as  $email) {
            // how to send emails in laravel
            Mail::To($email)->send(new NotifyEmail($data));
        }
    }
}
