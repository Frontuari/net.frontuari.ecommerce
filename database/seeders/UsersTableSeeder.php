<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        // \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 16,
                'last_ip' => NULL,
                'last_activity' => '2020-02-23 15:44:31',
                'password' => bcrypt('hola'),
                'cant_orders' => 0,
                'peoples_id' => 3,
                'coins_id' => NULL,
                'groups_id' => NULL,
                'name' => 'Francisco suarez',
                'email' => 'prueba@prueba.com',
                'validateemail' => NULL,
                'email_verified_at' => NULL,
                'failed_attempts' => 0,
                'purchase_quantity' => 1,
                'remember_token' => NULL,
                'created_at' => '2020-02-23 19:44:30',
                'updated_at' => '2020-02-23 21:41:13',
                'avatar' => 'users/default.png',
                'role_id' => 2,
                'settings' => '{"locale":"es"}',
            ),
            1 => 
            array (
                'id' => 17,
                'last_ip' => NULL,
                'last_activity' => '2020-04-14 08:53:06',
                'password' => bcrypt('1234'),
                'cant_orders' => 0,
                'peoples_id' => NULL,
                'coins_id' => NULL,
                'groups_id' => NULL,
                'name' => NULL,
                'email' => 'graficoa@gmail.com',
                'validateemail' => NULL,
                'email_verified_at' => NULL,
                'failed_attempts' => 0,
                'purchase_quantity' => 0,
                'remember_token' => 'LbOehgYs7njqRoZzURpqO05GSjunhlZabR1LlknxxAx7XjYgUZQYP27DVfst',
                'created_at' => '2020-04-14 12:53:05',
                'updated_at' => '2020-04-14 12:53:05',
                'avatar' => 'users/default.png',
                'role_id' => 4,
                'settings' => '{"locale":"es"}',
            ),
            2 => 
            array (
                'id' => 21, // UsuarioMAsterMind
                'last_ip' => NULL,
                'last_activity' => now(),
                'password' => bcrypt('admin'), // Encriptado con bcrypt
                'cant_orders' => 0,
                'peoples_id' => NULL,
                'coins_id' => NULL,
                'groups_id' => NULL,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'validateemail' => NULL,
                'email_verified_at' => now(),
                'failed_attempts' => 0,
                'purchase_quantity' => 0,
                'remember_token' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'avatar' => 'users/default.png',
                'role_id' => 1, // Ajusta según la lógica de roles en tu sistema
                'settings' => '{"locale":"es"}',
            ),
            3 => 
            array (
                'id' => 18,
                'last_ip' => NULL,
                'last_activity' => '2020-04-15 19:00:38',
                'password' => bcrypt('arr'),
                'cant_orders' => 0,
                'peoples_id' => 4,
                'coins_id' => NULL,
                'groups_id' => NULL,
                'name' => 'Leonardo melendez',
                'email' => 'ds000082a@gmail.com',
                'validateemail' => '737586',
                'email_verified_at' => '2020-04-15 19:12:31',
                'failed_attempts' => 0,
                'purchase_quantity' => 0,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'avatar' => 'users/default.png',
                'role_id' => NULL,
                'settings' => NULL,
            ),
            4 => 
            array (
                'id' => 20,
                'last_ip' => NULL,
                'last_activity' => '2020-04-15 19:53:11',
                'password' => bcrypt('arrollo'),
                'cant_orders' => 0,
                'peoples_id' => 6,
                'coins_id' => NULL,
                'groups_id' => NULL,
                'name' => 'maria',
                'email' => 'ds000082@gmail.com',
                'validateemail' => '737586',
                'email_verified_at' => '2020-04-15 19:53:11',
                'failed_attempts' => 0,
                'purchase_quantity' => 0,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'avatar' => 'users/default.png',
                'role_id' => NULL,
                'settings' => NULL,
            ),
            5 => 
            array (
                'id' => 14,
                'last_ip' => NULL,
                'last_activity' => '2020-01-23 14:45:09',
                'password' => bcrypt('siniestro'),
                'cant_orders' => 0,
                'peoples_id' => NULL,
                'coins_id' => NULL,
                'groups_id' => NULL,
                'name' => 'Administrador',
                'email' => 'admin751@admin.com',
                'validateemail' => NULL,
                'email_verified_at' => NULL,
                'failed_attempts' => 0,
                'purchase_quantity' => 0,
                'remember_token' => 'NGvCDEanDp9cCOIwQAo3il8AnkVSdES0es9q4XsK3KneLp8HMSqhwGnfwHnK',
                'created_at' => '2020-01-23 18:45:09',
                'updated_at' => '2020-04-13 21:54:13',
                'avatar' => 'users/default.png',
                'role_id' => 3,
                'settings' => '{"locale":"es"}',
            ),
        ));
        
        
    }
}