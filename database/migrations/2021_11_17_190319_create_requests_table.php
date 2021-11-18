<?php

use App\Models\Request;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('invoice')->nullable();
            $table->string('prf')->nullable();
            $table->string('feedback')->nullable();

            $table->unsignedBigInteger('raised_by');
            $table->foreign('raised_by')->references('id')->on('users');

            $table->unsignedBigInteger('raised_to');
            $table->foreign('raised_to')->references('id')->on('users');

            $table->string('status')->default("Request Raised");

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
        Schema::dropIfExists('requests');
    }
}
