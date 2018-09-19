<?php



use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     * php artisan make:migration create_articles_table
     * php artisan migrate
     */
    public function up()
    {
        Schema::create('article',function(Blueprint $table){
            $table->increments('id');
            $table->integer('category_id')->unsigned()->default(0)->comment('分类id');
            $table->string('title')->comment('标题');
            $table->text('content')->comment('内容');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
