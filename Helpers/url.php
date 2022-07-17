<?php

function url($action, $queryParams = [])
{
    global $route;

    return $route->url($action, $queryParams);
}
