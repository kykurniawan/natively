<?php

class Request
{
    public $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
}