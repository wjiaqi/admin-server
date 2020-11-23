<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * 文章
         */
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 128)->default(null)->nullable()->comment('文章标题');
            $table->text('content')->default(null)->nullable()->comment('内容');
            $table->unsignedInteger('sort')->default(0)->nullable()->comment('排序');
            $table->json('pic')->default(null)->nullable()->comment('图片数组');
            $table->unsignedTinyInteger('type')->default(1)->nullable()->comment('文章类型: 1=正常文章；2=轮播图');
            $table->unsignedTinyInteger('status')->default(0)->nullable()->comment('状态:1=启用;0=禁用');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article', function (Blueprint $table) {
            //
        });
    }
}
