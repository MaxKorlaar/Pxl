<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    /**
     * Class UpdateUsersAddToken
     */
    class UpdateUsersAddToken extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::table('users', function (Blueprint $table) {
                $table->string('upload_token', 70)->unique()->nullable();
                $table->string('delete_token', 70)->unique()->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('upload_token');
                $table->dropColumn('delete_token');
            });
        }
    }
