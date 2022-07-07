<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignGroupsTable extends Migration
{

    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }


    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign('groups_user_id_foreign');
        });
    }
}