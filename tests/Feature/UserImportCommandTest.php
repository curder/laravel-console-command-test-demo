<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Class UserImportCommandTest
 *
 * @package Tests\Feature
 */
class UserImportCommandTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            'https://randomuser.me/api/?results=7&inc=gender,email,nat,phone' => Http::response('{"results":[{"gender":"male","email":"onni.hannula@example.com","phone":"05-807-224","nat":"FI"},{"gender":"female","email":"edel.blystad@example.com","phone":"54152568","nat":"NO"},{"gender":"male","email":"armyn.rdyyn@example.com","phone":"079-97254034","nat":"IR"},{"gender":"male","email":"ralph.mitchell@example.com","phone":"061-104-0227","nat":"IE"},{"gender":"female","email":"awyn.rdyy@example.com","phone":"067-98901308","nat":"IR"},{"gender":"male","email":"dylan.williams@example.com","phone":"(049)-122-9621","nat":"NZ"},{"gender":"female","email":"hailey.gauthier@example.com","phone":"581-835-8803","nat":"CA"}],"info":{"seed":"b32f36cac8df5c95","results":7,"page":1,"version":"1.3"}}'),
        ]);
    }

    /** @test */
    public function it_imports_users_to_the_database(): void
    {
        $this->artisan('import:users')
            ->expectsQuestion("Please provider the URL to the users", 'https://randomuser.me/api/?results=7&inc=gender,email,nat,phone')
            ->expectsOutput('Thank you, users have been imported.')
            ->assertExitCode(0);

        $this->assertCount(7, User::all());

        $this->assertDatabaseHas((new User())->getTable(), [
            "gender" => "male",
            "email" => "onni.hannula@example.com",
            "phone" => "05-807-224",
            "nat" => "FI",
        ]);
    }

    /** @test */
    public function it_accepts_the_url_as_an_option(): void
    {
        $this->artisan('import:users --url=https://randomuser.me/api/?results=7&inc=gender,email,nat,phone')
             ->expectsOutput('Thank you, users have been imported.')
             ->assertExitCode(0);

        $this->assertCount(7, User::all());
    }
}
