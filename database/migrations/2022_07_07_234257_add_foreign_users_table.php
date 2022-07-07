<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignUsersTable extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->foreign('group_id')
                ->references('id')
                ->on('groups');
        });
    }
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_group_id_foreign');
        });
    }
}