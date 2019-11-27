<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //用户表
        Schema::create('user',function (Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id')->comment('主键');
            $table->string('username',100)->unique()->comment('用户名');
            $table->string('password',100)->comment('密码');
            $table->string('name',30)->comment('名字');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('remember_token', 100)->nullable()->comment('记住密码');
            $table->timestamp('last_login_time')->comment('上次登录时间');
            $table->ipAddress('last_login_ip')->comment('上次登录ip');
            $table->tinyInteger('status')->default(0)->comment('状态(0:正常,1:禁用)');
            $table->timestamps();
        });

        //角色表
        Schema::create('role',function (Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id')->comment('主键');
            $table->string('desc')->comment('角色描述');
            $table->timestamps();
        });

        //权限表
        Schema::create('permission',function (Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id')->comment('主键');
            $table->string('desc')->comment('权限描述');
            $table->string('uri')->comment('地址');
            $table->timestamps();
        });

        //用户、角色关系表
        Schema::create('user_role_rel',function (Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id')->comment('主键');
            $table->timestamps();
        });

        //角色、权限关系表
        Schema::create('role_permission_rel',function (Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id')->comment('主键');
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
        Schema::dropIfExists('user');
        Schema::dropIfExists('role');
        Schema::dropIfExists('permission');
        Schema::dropIfExists('user_role_rel');
        Schema::dropIfExists('role_permission_rel');
    }
}
