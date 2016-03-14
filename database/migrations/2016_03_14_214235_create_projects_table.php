<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name', 150);
            $table->string('creator', 150)->nullable();
            $table->string('adress_creator', 150)->nullable();
            $table->string('email_creator', 50)->nullable();
            $table->string('phone_creator', 15)->nullable();
            $table->string('contact', 150)->nullable();
            $table->string('adress_contact', 150)->nullable();
            $table->string('email_contact', 50)->nullable();
            $table->string('phone_contact', 15)->nullable();
            $table->longText('identity')->nullable();
            $table->string('type', 30);
            $table->longText('context')->nullable();
            $table->longText('demand')->nullable();
            $table->longText('goal')->nullable();
            $table->longText('other')->nullable();
            $table->string('status', 25)->default('waiting approval');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
