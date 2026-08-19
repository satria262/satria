<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('db:seed-all', function () {
    $this->comment('Seeding all tables with dummy data...');
    $this->call('db:seed', ['--class' => 'Database\\Seeders\\DatabaseSeeder']);
    $this->comment('Database seed complete.');
})->purpose('Seed all database tables with relational dummy filler data');
