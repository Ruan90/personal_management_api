<?php

use App\Models\Author;
use App\Models\Reference;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("description")->nullable(false);
            $table->text("note")->nullable(true);
            $table->integer("position")->nullable(true)->unique();
            $table->boolean("commit")->default(false)->nullable(false);
            $table->foreignIdFor(Reference::class)->nullable(true);
            $table->foreignIdFor(Author::class)->nullable(false);
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
        Schema::dropIfExists('descriptions');
    }
}
