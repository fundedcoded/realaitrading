<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // Insert admin user if not exists
        if (!DB::table('users')->where('email', 'admin@realaitrading.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'admin@realaitrading.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert backup admin user if not exists
        if (!DB::table('users')->where('email', 'adminq@realaitrading.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'adminq@realaitrading.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('users')->whereIn('email', [
            'admin@realaitrading.com',
            'adminq@realaitrading.com',
        ])->delete();
    }
};
