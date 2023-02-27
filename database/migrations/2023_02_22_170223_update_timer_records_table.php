<?php

use App\Models\User;
use App\Models\UserTag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timer_records', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'user_id')->after('id');
            $table->dropColumn('tag_name');
            $table->foreignIdFor(UserTag::class, 'user_tag_id')->after('user_id');
            $table->renameColumn('started_time', 'start_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timer_records', function (Blueprint $table) {
            //
        });
    }
};
