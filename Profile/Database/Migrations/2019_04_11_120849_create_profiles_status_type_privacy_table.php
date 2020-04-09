<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesStatusTypePrivacyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles_status_type_privacy', function (Blueprint $table) {
            $table->tinyInteger('id')->index();
            $table->tinyInteger('type_privacy_id')->index();
            $table->char('status_privacy', 30)->index();
            $table->char('description_status', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles_status_type_privacy');
    }
}
