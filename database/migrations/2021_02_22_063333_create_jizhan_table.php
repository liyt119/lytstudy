<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Jizhan;

class CreateJizhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jizhan', function (Blueprint $table) {
            $table->id();
            $table->string('bh')->comment('基站编号');
            $table->string('name')->comment('基站名称');
            $table->string('region')->comment('端局');
            $table->string('lon')->nullable()->comment('经度');
            $table->string('lat')->nullable()->comment('纬度');
            $table->string('add')->nullable()->comment('基站站址');
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
        Schema::dropIfExists('jizhan');
    }
}
