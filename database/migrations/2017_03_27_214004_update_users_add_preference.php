<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    /**
     * Class UpdateUsersAddPreference
     */
    class UpdateUsersAddPreference extends Migration {
        public function up() {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('default_image_deletion_time')->nullable();
                $table->boolean('prefers_preview_link')->default(false);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('default_image_deletion_time');
                $table->dropColumn('prefers_preview_link');
            });
        }
    }
