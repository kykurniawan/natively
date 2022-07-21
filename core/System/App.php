<?php

namespace Core\System;

use App\Router;
use Exception;

class App
{
    private Router $router;

    public Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->router = new Router($this);
    }

    public function run()
    {
        // validate config first
        $this->validateConfig();

        // Route
        $this->router->setUp();
        $this->router->register();
        $this->router->handle();
    }

    public function getRouter()
    {
        return $this->router;
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
