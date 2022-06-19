<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_form(){
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function test_user_duplication(){
        $user1 = User::make([
            'name'=> 'Jone Doe',
            'email' => 'johndoe@gmail.com'

        ]);

        $user2 = User::make([
            'name'=> 'Dary',
            'email' => 'dary@gmail.com'

        ]);
        $this->assertTrue($user1->name != $user2-> name);
    }
    public function test_delete_users(){
        $user = User::factory()->count(1)->make();
        $user = User::first();
        if($user){
            $user->delete();
        }
        $this->assertTrue(true);
    }
    public function test_if_seeders_works(){
        $this->seed();
    }

    // public function testCreateLoginAuth() {
    //     $userTest = factory(User::class)->create([
    //         'first_name' => 'John',
    //         'last_name' => 'Doe',
    //         'name' => 'johnDoe',
    //         'email' => 'john@example.com',
    //         'password' => bcrypt($password = 'i-love-laravel'),
    //     ]);
    // }
}