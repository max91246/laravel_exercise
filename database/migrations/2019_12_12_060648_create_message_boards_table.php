<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_boards', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dateTime('dateTime')->nullable()->change();
            //$table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_boards', function (Blueprint $table) {
            $table->text('content');
        });
    }
}
