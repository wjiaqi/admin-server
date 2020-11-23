<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mobile', 20)->comment('手机号码');
            $table->string('password', 255)->default(null)->nullable()->comment('登陆密码');
            $table->string('nickname', 50)->default(null)->nullable()->comment('昵称');
            $table->string('avatar', 255)->default(null)->nullable()->comment('头像');
            $table->string('email', 255)->default(null)->nullable()->comment('电子邮箱');
            $table->unsignedTinyInteger('sex')->default(0)->nullable()->comment('性别:1=男；2=女');
            $table->unsignedInteger('birthday')->default(0)->nullable()->comment('生日');
            $table->unsignedInteger('reg_time')->default(0)->comment('注册时间');
            $table->unsignedInteger('reg_ip')->default(0)->comment('注册IP');
            $table->unsignedTinyInteger('status')->default(0)->comment('用户状态: 0=限制登陆; 1=正常');
            $table->unsignedTinyInteger('channel_id')->comment('渠道id, 1=内网');
            // 索引
            $table->index('mobile');
            $table->index('status');
            $table->index('channel_id');
        });

        //用户登录记录表
        Schema::create('user_login_record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index()->comment('用户ID');
            $table->unsignedInteger('login_time')->comment('登录时间');
            $table->unsignedInteger('login_ip')->comment('登录ip');
            $table->string('device', 500)->nullable()->comment('设备信息');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
}
