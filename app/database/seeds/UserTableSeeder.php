<?php

class UserTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();

        $adminRole = new User;
        $adminRole->name = 'admin';
        $adminRole->email = 'admin@admin.com';
        $adminRole->password = Hash::make(Input::get('admin'));
        $adminRole->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );
        $user->confirm();
    }

}