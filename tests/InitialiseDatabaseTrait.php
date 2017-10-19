<?php

namespace Tests;

use DatabaseSeeder;

trait InitialiseDatabaseTrait
{
    public function backupDatabase()
    {
        if (!$this->app) {
            $this->refreshApplication();
        }
        $db = $this->app->make('db')->connection();
        if (file_exists($db->getDatabaseName())) {
            unlink($db->getDatabaseName());
        }
        touch($db->getDatabaseName());
        $this->artisan('migrate',['--env' => 'dusk.local']);
        $this->seed(DatabaseSeeder::class);
    }
}