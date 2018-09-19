<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert(
        [

            [
                'category_id' => 4,
                'title' => '文章4',
                'content' => '内容4',
                'created_at'=>date("Y-m-d H:i:s",time()),
                'updated_at'=>date("Y-m-d H:i:s",time())
            ],
            [
                'category_id' => 5,
                'title' => '文章5',
                'content' => '内容5',
                'created_at'=>date("Y-m-d H:i:s",time()),
                'updated_at'=>date("Y-m-d H:i:s",time())
            ]
        ]
    );
    }
}
