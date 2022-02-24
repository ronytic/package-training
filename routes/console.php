<?php

use Illuminate\Support\Facades\Schema;

Artisan::command('package-training:install', function () {

    if (!Schema::hasTable('sample_skeleton')) {
        Schema::create('sample_skeleton', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('status', ['ENABLED', 'DISABLED'])->default('ENABLED');
            $table->timestamps();
        });
    }


    // Create the package tables
    if (!Schema::hasTable('package_countries')) {
        Schema::create('package_countries', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('region');
            $table->string('country_id');
            $table->enum('status', ['ENABLED', 'DISABLED'])->default('ENABLED');
            $table->timestamps();
        });
    }


    Artisan::call('vendor:publish', [
        '--tag' => 'package-training',
        '--force' => true
    ]);

    $this->info('Package Training has been installed');
})->describe('Installs the required js files and table in DB');

Artisan::command('package-training:uninstall', function () {
    // Command
    $this->info('HOLA como estas');
});
Artisan::command('package-training:showmessage', function () {
    // Command
    $this->info('HOLA como estas');
});
