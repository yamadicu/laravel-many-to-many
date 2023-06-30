<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Category;
use App\Models\Admin\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            'html',
            'css',
            'javacript',
            'php',
            'laravel'
        ];

        foreach ($technologies as $elem) {
            $new_tech = new Technology();
            $new_tech->name = $elem;
            $new_tech->slug = Str::slug($new_tech->name);
            $new_tech->save();
        } 
    }
}
