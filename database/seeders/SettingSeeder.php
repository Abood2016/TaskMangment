<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::create([
            'title' => 'Nano it',
            'email' =>'nano@info.com',
            'sub_title' =>'Task Management System',
            'contact_number' =>'+9723664755',
        ]);
    }
}
