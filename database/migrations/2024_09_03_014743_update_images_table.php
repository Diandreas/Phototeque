<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('identification_number', 255)->after('name')->unique();
            $table->date('creation_date')->nullable()->after('identification_number');
            $table->string('author', 255)->after('creation_date');
            $table->string('source', 255)->after('author');
            $table->string('support', 255)->after('source');
            $table->string('dimensions', 255)->after('support');
            $table->string('color', 255)->after('dimensions');
            $table->string('technique', 255)->after('color');
            $table->string('main_subject', 255)->after('technique');
            $table->string('represented_elements')->after('main_subject');
            $table->string('actions_represented')->after('represented_elements');
            $table->string('context')->after('actions_represented');
            $table->string('keywords')->after('context');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('identification_number');
            $table->dropColumn('creation_date');
            $table->dropColumn('author');
            $table->dropColumn('source');
            $table->dropColumn('support');
            $table->dropColumn('dimensions');
            $table->dropColumn('color');
            $table->dropColumn('technique');
            $table->dropColumn('main_subject');
            $table->dropColumn('represented_elements');
            $table->dropColumn('actions_represented');
            $table->dropColumn('context');
            $table->dropColumn('keywords');
        });
    }
};
