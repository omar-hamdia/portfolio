<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\About;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // تنظيف الجداول أولاً (اختياري)
        User::create([
            'name' => 'Omar',
            'email' => 'admin@omar.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $this->command->info('تم إنشاء بيانات الملف الشخصي بنجاح!');
    }
}