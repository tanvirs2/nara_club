<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberLibIdToMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('member_lib_id')->after('game_id');

            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('name')->change();
            $table->dropColumn('member_lib_id');

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
        });
    }
}
