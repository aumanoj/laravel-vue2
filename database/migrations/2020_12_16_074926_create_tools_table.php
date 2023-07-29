<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->integer('tool_id');
            $table->integer('provider_id');
            $table->string('vendor');
            $table->string('tool_name');
            $table->decimal('api_price',10,2);
            $table->decimal('selling_price',10,2);
            $table->decimal('mrp',10,2);
            $table->string('summury');
            $table->string('detail_summury');
            $table->string('estimated_time');
            $table->string('guaranted time');
            $table->string('instruction');
            $table->string('is_sip');
            $table->string('is_imei');
            $table->enum('unlock_type', ['imei_unlock','software_unlock']);
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
        Schema::dropIfExists('tools');
    }
}
