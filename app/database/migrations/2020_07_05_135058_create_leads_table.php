<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'leads';

        Schema::create($tableName, function (Blueprint $table) {
            $table->id('lead_id');
            $table->unsignedBigInteger('lead_user_id');
            $table->string('lead_name')->comment('ФИО клиента');
            $table->string('lead_phone')->default('')->comment('Телефон');
            $table->string('lead_email')->default('')->comment('Email');
            $table->string('lead_source')->default('')->comment('source');
            $table->json('lead_fields')->default(new Expression('(JSON_ARRAY())'))
                ->comment('Дополнительная информация о заказе. array of arrays');
            $table->timestamps();
            $table->foreign('lead_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::statement("alter table $tableName COMMENT = 'Добавление лида'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
