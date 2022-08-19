<?php

namespace Core\System;

use App\Migration;
use App\Router;
use Exception;

class App
{
    private Router $router;

    public Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;

        // validate config first
        $this->validateConfig();

        // Route
        $this->router = new Router($this);
        $this->router->setUp();
        $this->router->register();
    }

    public function run()
    {
        // Handle our route actions
        $this->router->handle();
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getMigration()
    {
        return new Migration;
    }

    private function validateConfig()
    {
        // Check for required config
        if ($this->config->baseURL === null) {
            throw new Exception("Base URL not set");
        } else {
            if (filter_var($this->config->baseURL, FILTER_VALIDATE_URL) === false) {
                throw new Exception("Invalid base URL");
            }
        }
    }
}
