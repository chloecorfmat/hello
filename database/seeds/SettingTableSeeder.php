<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'key' => 'ff.email',
            'type' => 'feature_flipping',
            'value' => 'true',
        ]);
    }
}
