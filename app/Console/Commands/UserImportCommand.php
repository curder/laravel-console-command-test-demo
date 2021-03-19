<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

/**
 * Class UserImportCommand
 *
 * @example php artisan import:users
 * @example php artisan import:users --url=https://randomuser.me/api/?results=7&inc=gender,email,nat,phone
 *
 * @package App\Console\Commands
 */
class UserImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users to database from remote URL.';

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
    public function handle() : int
    {

        $url = $this->option('url') ?: $this->ask('Please provider the URL to the users');

        $response = Http::get($url);

        $users = $response->json('results');

        User::insert($users);

        $this->info('Thank you, users have been imported.');

        return 0;
    }
}
