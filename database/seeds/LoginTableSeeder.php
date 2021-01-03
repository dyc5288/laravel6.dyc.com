<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('login')->insert([
            ['userId' => '1', 'login_at' => time()],
            ['userId' => '2', 'login_at' => time()]
        ]);
    }
}
