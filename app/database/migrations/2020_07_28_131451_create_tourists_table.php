<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateTouristsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name')->comment('ФИО туриста');
            $table->string('name_lat')->comment('ФИО туриста на латинице');
            $table->enum('gender', ['f', 'm'])->comment('Пол туриста. f - женский m - мужской');
            $table->string('address')->comment('Адрес');
            $table->string('tel')->comment('Телефон, можно несколько');
            $table->string('email')->comment('Email');
            $table->string('passport_series')->comment('Серия загран. паспорта');
            $table->string('passport_number')->comment('Номер загран. паспорта');
            $table->string('passport_who')->comment('Кем выдан загран. паспорт');
            $table->date('passport_when')->comment('Когда выдан загран. паспорт');
            $table->date('passport_till')->comment('Срок действия загран. паспорта');
            $table->string('passport_series_rus')->comment('Серия внутреннего паспорта');
            $table->string('passport_number_rus')->comment('Номер внутреннего паспорта');
            $table->string('passport_who_rus')->comment('Кем выдан внутренний паспорт');
            $table->date('passport_when_rus')->comment('Когда выдан внутренний паспорт');
            $table->date('dr')->comment('Дата рождения туриста');
            $table->boolean('receive_sms')->comment('Получает ли турист SMS');
            $table->boolean('receive_email')->comment('Получает ли турист Email');
            $table->integer('manager_id')->comment('ID менеджера');
            $table->integer('office_id')->comment('ID офиса');
            $table->json('groups')->default(new Expression('(JSON_ARRAY())'))->comment('Список ID групп в которые входит турист');
            $table->json('contacts')->default(new Expression('(JSON_ARRAY())'))->comment('Контактная информация. 1 - VK, 2 - FB, 3 - Одноклассники, 4 - ICQ, 5 - Skype');
            $table->text('vk')->comment('JSON строка. Связанные аккаунты ВК');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::statement("alter table tourists COMMENT = 'Туристы'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tourists');
    }
}
