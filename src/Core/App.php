<?php

namespace Core;

use App\Route as AppRoute;

class App
{
    protected string $baseURL;
    protected AppRoute $appRoute;

    public function __construct()
    {
        $this->appRoute = new AppRoute($this);
    }

    public function setBaseURL(string $baseURL): App
    {
        $this->baseURL = $baseURL;

        return $this;
    }

    public function getBaseURL(): string
    {
        return $this->baseURL;
    }

    public function route(): AppRoute
    {
        return $this->appRoute;
    }

    public function run(callable $callback = null)
    {
        $this->appRoute->boot();
        $this->appRoute->register();
        $this->appRoute->handle();

        if ($callback) {
            $callback();
        }
    }
}
