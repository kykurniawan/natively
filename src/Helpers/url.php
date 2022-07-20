<?php

function url($action, $queryParams = [])
{
    global $app;

    return $app->route()->url($action, $queryParams);
}
