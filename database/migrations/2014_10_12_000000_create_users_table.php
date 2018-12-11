<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('weixin_openid')->unique()->nullable()->comment('用户微信本平台ID');
            $table->string('weixin_unionid')->unique()->nullable()->comment('用户微信各平台唯一ID');
            $table->string('password')->nullable();
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('intro')->nullable()->comment('简介');
            $table->integer('notification_count')->unsigned()->default(0)->comment('用户未读数量');
            $table->timestamp('last_actived_at')->nullable()->comment('最后访问时间');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
