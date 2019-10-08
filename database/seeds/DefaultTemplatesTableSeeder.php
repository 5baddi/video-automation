<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('VA_Custom_templates')->insert([
            'vau_id'        =>  124,
            'name'          =>  'Super Social Media',
            'preview_path'  =>  'https://s3-eu-west-1.amazonaws.com/vauvideo/assets/vauvideo/vau-public/super_social_media/super_social_media_THUMB.mp4'
        ]);
    }
}
