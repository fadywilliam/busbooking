<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\cities;
use App\Models\roles;
use App\Models\User;
use App\Models\trips;

use Hash;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        DB::insert("INSERT INTO `cities` (`name`)
        VALUES
        ('Cairo'),
        ('AlFayyum'),
        ('AlMinya'),
        ('Asyut');
        ");

        DB::insert("INSERT INTO `seats` (`num`)
        VALUES (1),(2),(3),(4),(5),(6),(7),(8),(9),(10),(11),(12);");
        
        DB::insert("INSERT INTO `roles` (`name`)
        VALUES ('admin'),('superadmin'),('user');
        ");


        User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234'),
            'role_id' => (int)roles::select('id')->where('name','=','admin')->first()->id
        ]);
        User::firstOrCreate([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('test1234'),
            'role_id' => (int)roles::select('id')->where('name','=','user')->first()->id
        ]);

      
        DB::insert("INSERT INTO `trips` (`from`,`to`,`available_seats`)
        VALUES 
            (1,2,12),
            (1,3,12),
            (1,4,12),
            (2,3,12),
            (2,4,12),
            (3,4,12);
            ");
      
}
}
