<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFitmentQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fitment_quotations', function (Blueprint $table) {
            $table->id();           
            $table->string('reference')->unique();
            $table->string('vin',20);
            $table->string('make',255);
            $table->string('manufacturer',255);
            $table->year('year');
            $table->string('registration',20);
            $table->date('issue_date');
            $table->date('expires_date');
            $table->float('fitment_cost', 8, 2);
            $table->integer('fitment_centre_id');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('email',255);
            $table->string('mobile',30);
            $table->boolean('accepted')->deafult(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fitment_quotations');
    }
}
