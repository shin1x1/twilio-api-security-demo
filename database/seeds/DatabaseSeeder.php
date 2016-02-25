<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;

class DatabaseSeeder extends Seeder
{
    /**
     * @var User
     */
    private $eloquent;
    /**
     * @var BcryptHasher
     */
    private $hasher;

    public function __construct(User $eloquent, BcryptHasher $hasher)
    {
        $this->eloquent = $eloquent;
        $this->hasher = $hasher;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->eloquent->unguard();

        $this->eloquent->create([
            'name' => 'user',
            'email' => 'user',
            'password' => $this->hasher->make('pass'),
        ]);

        $this->eloquent->reguard();
    }
}
