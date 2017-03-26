<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    /**
     * Class CreateImagesTable
     */
    class CreateImagesTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('images', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable(); // 'Fancy' name - Supplied by ShareX for example
                $table->string('filename'); // Same as urlname
                $table->string('url_name');
                $table->string('extension');
                $table->string('filetype');
                $table->string('file_path')->nullable(); // Path to directory where the file is located
                $table->integer('domain_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->ipAddress('uploaded_from');
                $table->integer('image_created_on')->nullable(); // Retrieve info from image metadata
                $table->integer('created_at');
                $table->integer('updated_at');
                $table->integer('deleted_at')->nullable();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('images');
        }
    }
