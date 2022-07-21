<?php

function url($action, $queryParams = [])
{
    global $app;

    return $app->getRouter()->url($action, $queryParams);
}
