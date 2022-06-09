<?php


namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait DatabaseSetup
{
    protected static $migrated = false;

    public function setupDatabase() 
    {
        if ($this->isInMemory()) { //it checks if the tests are running in memory
            $this->setupInMemoryDatabase();
        } else {
            $this->setupTestDatabase(); //if not, it sets up the regular test DB
        }
    }

    protected function isInMemory()
    {
        return config('database.connections')[config('database.default')]['database'] == ':memory:';
    }

    protected function setupInMemoryDatabase()
    {
        $this->artisan('migrate:fresh --seed');
        $this->app[Kernel::class]->setArtisan(null);
    }

    protected function setupTestDatabase() //checks if the test DB is in sync with the main DB
    {
        if (!static::$migrated) {  //if recent migrations were ran on the regular DB
            $this->whenMigrationsChange(function() {
                $this->artisan('migrate:fresh --seed'); //the test DB will run the new php artisan migrate
                $this->app[Kernel::class]->setArtisan(null);
            });
            static::$migrated = true;
        }
        $this->beginDatabaseTransaction();
    }

    public function beginDatabaseTransaction()
    {
        $database = $this->app->make('db');
        foreach ($this->connectionsToTransact() as $name) {
            $database->connection($name)->beginTransaction();
        }
        $this->beforeApplicationDestroyed(function () use ($database) {
            foreach ($this->connectionsToTransact() as $name) {
                $database->connection($name)->rollBack();
            }
        });
    }

    protected function connectionsToTransact()
    {
        return property_exists($this, 'connectionsToTransact')
            ? $this->connectionsToTransact : [null];
    }

    protected function getMigrationsMd5()
    {
        return md5(collect(glob(base_path('database/migrations/*')))
            ->map(function ($f) {
                return file_get_contents($f);
            })->implode(''));
    }

    protected function whenMigrationsChange($callback)
    {
        $md5 = $this->getMigrationsMd5();
        $path = storage_path('app/migrations_md5.txt'); //we create a text file in the storage path
        if(!file_exists($path) || ($md5 !== file_get_contents($path))) { //check if the contents of the two files are different. 
            file_put_contents($path, $md5); //if it is different, we run the migration again. if not, nothing happens
        }
    }
}