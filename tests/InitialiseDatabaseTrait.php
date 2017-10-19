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
        $dbName = $db->getDatabaseName();
        if (file_exists($dbName)) {
            unlink($dbName);
        }
        touch($dbName);
        $this->artisan('migrate',['--env' => 'dusk.local']);
    }
}