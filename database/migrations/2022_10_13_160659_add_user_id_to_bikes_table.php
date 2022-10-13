<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('imagen');
            $table->foreign('user_id')->references('id')->on('users');
        });

        // Note: Fill user_id with random users in phpMyAdmin (valid user IDs go from 19 to 25)
        // UPDATE bikes SET user_id = FLOOR( 19 + RAND( ) * 6 );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->dropForeign('bikes_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
