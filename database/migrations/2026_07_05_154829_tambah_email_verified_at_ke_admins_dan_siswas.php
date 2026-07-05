<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable()->after('email');
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
        });
    }
};
