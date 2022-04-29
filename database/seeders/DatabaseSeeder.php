<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::insert("INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES ('95f97367-73a9-475a-b817-16c0d567d697', NULL, 'Laravel Password Grant Client', '331ONKkzjiVKT52ZeReYYN9xCjsQo4iCTPmNICvU', 'users', 'http://localhost', 0, 1, 0, '2022-04-03 11:42:35', '2022-04-03 11:42:35');");
        $this->call([
           ProductsSeeder::class,
        ]);
    }
}
