<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    /**
     * Class UpdateUsersTableSocial
     */
    class UpdateUsersTableSocial extends Migration {
        public function up() {
            Schema::table('users', function (Blueprint $table) {
                $table->string('embed_name')->nullable();
                $table->string('twitter_username')->nullable();
                $table->string('embed_name_url')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('embed_name');
                $table->dropColumn('twitter_username');
                $table->dropColumn('embed_name_url');
            });
        }
    }
