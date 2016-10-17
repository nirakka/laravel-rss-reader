<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColToFavoriteArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('follow_article', 'favorite_article');
        Schema::table('favorite_article', function (Blueprint $table) {
            //
            $table->smallInteger('status')->after('article_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('favorite_article', 'follow_article');
        Schema::table('follow_article', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
}
