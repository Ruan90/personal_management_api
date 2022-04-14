<?php

use App\Models\Category;
use App\Models\Description;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Description::class)->nullable(false);
            $table->foreignIdFor(Category::class)->nullable(false);
            $table->softDeletes("deleted_at");
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
        Schema::dropIfExists('descriptions_categories');
    }
}
