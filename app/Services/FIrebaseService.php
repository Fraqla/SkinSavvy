<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Auth;

class FirebaseService
{
    protected $factory;
    protected $database;
    protected $auth;

    public function __construct()
    {
        $this->factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials'));

        $this->database = $this->factory->createDatabase();
        $this->auth = $this->factory->createAuth();
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function getAuth(): Auth
    {
        return $this->auth;
    }
}
