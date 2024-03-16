<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('specialization')->nullable();
            $table->string('gender')->nullable();
            $table->string('identification_number')->nullable();
            $table->text('availability_schedule')->nullable();
            $table->text('appointment_preferences')->nullable();
            $table->string('profile_picture')->nullable();
        });
    }

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('specialization');
            $table->dropColumn('gender');
            $table->dropColumn('identification_number');
            $table->dropColumn('availability_schedule');
            $table->dropColumn('appointment_preferences');
            $table->dropColumn('profile_picture');
        });
    }
}
