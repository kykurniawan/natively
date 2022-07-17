<?php

class Response
{
    public $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function json($data)
    {
        $json = json_encode($data);
        header("Content-Type: application/json; charset=utf-8");
        echo $json;
    }

    public function view($path, $data = [])
    {
        header("Content-Type: text/html; charset=UTF-8");
        extract($data);
        unset($data);
        include_once(VIEWS_PATH . "/" . $path . '.php');
        
        return $this;
    }
}
