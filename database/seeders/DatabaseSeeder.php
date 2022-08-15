<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Interfaces\Message\IConfigured;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $notification_messages = config('app.notification_message');
        foreach ($notification_messages as $notification_message) {
            $notification_message = app($notification_message, ['code' => 0]);
            if($notification_message instanceof IConfigured)
            {
                $notification_message->defaultConfig();
            }
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
