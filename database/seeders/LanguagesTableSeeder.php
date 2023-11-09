<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = [
            ['locale' => 'ua', 'prefix' => '/ua'],
            ['locale' => 'en', 'prefix' => '/en'],
            ['locale' => 'ru', 'prefix' => '/ru'],
        ];

        foreach ($langs as $lang) {
            Language::create($lang);
        }

    }
}
