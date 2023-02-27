<?php

use App\Models\UserTags;
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
            $table->foreignIdFor(Users::class, 'user_id')->after('id');
            $table->dropColumn('tag_name');
            $table->foreignIdFor(UserTags::class, 'tag_name')->after('user_id');
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
