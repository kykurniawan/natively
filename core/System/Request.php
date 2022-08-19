<?php

namespace Core\System;

class Request
{
    private App $app;
    private string $method;
    private string $queryString;
    private array $post = [];
    private array $get = [];

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->queryString = $_SERVER["QUERY_STRING"];
        $this->post = $_POST;
        $this->get = $_GET;
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
        return $this->get($this->app->getRouter()->getActionKey());
    }

    public function isGet(): bool
    {
        return $this->method() === "GET";
    }

    public function isPost(): bool
    {
        return $this->method() === "POST";
    }

    public function queryString()
    {
        return $this->queryString;
    }

    public function get($key = null)
    {
        if ($key) {
            if (!isset($this->get[$key])) {
                return null;
            }
            return htmlspecialchars($this->get[$key]);
        }
        return $this->get;
    }

    public function post($key = null)
    {
        if ($key) {
            if (!isset($this->post[$key])) {
                return null;
            }
            return htmlspecialchars($this->post[$key]);
        }

        return $this->post;
    }
}
