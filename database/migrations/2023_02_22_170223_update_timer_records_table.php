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
            $table->foreignIdFor(UserTags::class, 'user_tag_id')->change();
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
