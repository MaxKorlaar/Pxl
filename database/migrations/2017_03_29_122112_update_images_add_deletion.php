<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    /**
     * Class UpdateImagesAddDeletion
     */
    class UpdateImagesAddDeletion extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::table('images', function (Blueprint $table) {
                $table->integer('deletion_timestamp')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('images', function (Blueprint $table) {
                $table->dropColumn('deletion_timestamp');
            });
        }
    }
