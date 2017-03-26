<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    /**
     * Class CreateDomainTable
     */
    class CreateDomainTable extends Migration {
        public function up() {
            Schema::create('domains', function (Blueprint $table) {
                $table->increments('id');
                $table->string('domain'); // 'Fancy' name - Supplied by ShareX for example
                $table->string('protocol')->default('http'); // Same as urlname
                $table->string('user');
                $table->integer('created_at');
                $table->integer('updated_at');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('domains');
        }
    }
