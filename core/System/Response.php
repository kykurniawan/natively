<?php

namespace Core\System;

class Response
{
    private App $app;
    private int $statusCode = 200;
    private array $headers = [];

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function setHeader(string $headerName, $headerValue)
    {
        array_push($this->headers, $headerName . ": " . $headerValue);

        return $this;
    }

    public function json($data)
    {

        $this->setHeader("Content-Type", "application/json; charset=utf-8");
        $this->addHeader();
        http_response_code($this->statusCode);
        echo json_encode($data);
        return;
    }

    /**
     * @param string|array $path view file path relative to View folder
     */
    public function view($path, $data = [])
    {
        $this->setHeader("Content-Type", "text/html; charset=utf-8");
        $this->addHeader();
        http_response_code($this->statusCode);
        extract($data);
        unset($data);
        if (is_string($path)) {
            include_once(VIEW_PATH . "/" . $path . '.php');
        } elseif (is_array($path)) {
            foreach ($path as $p) {
                include_once(VIEW_PATH . "/" . $p . '.php');
            }
        }
        return;
    }

    public function body(string $body)
    {
        $this->addHeader();
        http_response_code($this->statusCode);

        echo $body;
        return;
    }

    private function addHeader()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
    }
}
