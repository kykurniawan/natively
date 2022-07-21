<?php

namespace Core\System;

class Request
{
    private App $app;
    private string $method;
    private string $queryString;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->queryString = $_SERVER["QUERY_STRING"];
    }

    public function app()
    {
        return $this->app;
    }

    public function method(bool $uppercase = true): string
    {
        return $uppercase ? strtoupper($this->method) : strtolower($this->method);
    }

    public function action(): string
    {
        return $this->query($this->app->getRouter()->getActionKey());
    }

    public function isGet(): bool
    {
        return $this->method() === "GET";
    }

    public function isPost(): bool
    {
        return $this->method() === "POST";
    }

    public function queries()
    {
        parse_str($this->queryString, $queries);

        return $queries;
    }

    public function query($key)
    {
        if (!isset($_GET[$key])) return null;

        return $_GET[$key];
    }
}
