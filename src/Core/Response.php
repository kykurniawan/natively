<?php

namespace Core;

class Response
{
    public function json($data)
    {
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($data);
        return;
    }

    public function view($path, $data = [])
    {
        header("Content-Type: text/html; charset=UTF-8");
        extract($data);
        unset($data);
        include_once(VIEW_PATH . "/" . $path . '.php');
        return;
    }
}
