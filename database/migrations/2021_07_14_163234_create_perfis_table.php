<?php

use App\Models\Perfil;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Perfil::tableName(), function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('imagem')->nullable();
            $table->smallInteger('categoria')->index();
            $table->text('descricao');
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
        Schema::dropIfExists(Perfil::tableName());
    }
}
