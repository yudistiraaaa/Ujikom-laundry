<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "yudis";
        $administrator->name = "Yudis";
        $administrator->email = "yudis@gmail.com";
        $administrator->outlet_id = 1;
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = Hash::make('12345678');

        $administrator->save();

        $this->command->info("User berhasil di insert");
    }
}
