<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create {--name=} {--email=} {--password=} {--token=}';

    protected $description = 'Create user and token';

    public function handle()
    {
        $user = User::create([
            'name' => $this->option('name'),
            'email' => $this->option('email'),
            'password' => bcrypt($this->option('password'))
        ]);

        $token = $user->createToken($this->option('token'))->accessToken;

        $this->line($token);
    }
}