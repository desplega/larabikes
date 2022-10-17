<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('poblacion', 255);
            $table->string('telefono', 32);
            $table->timestamps();
        });
        Schema::table('bikes', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->nullable()->after('user_id');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bikes', function(Blueprint $table) {
            $table->dropForeign('bikes_shop_id_foreign');
            $table->dropColumn('shop_id');
        });
        Schema::dropIfExists('shops');
    }
}
