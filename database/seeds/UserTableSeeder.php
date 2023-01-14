<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'=>'admin@gmail.com',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'triyasniko@gmail.com',
                'email'=>'triyasniko@gmail.com',
                'password'=>bcrypt('triyasniko'),
                'role'=>'user',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]
        ]);
    }
}
