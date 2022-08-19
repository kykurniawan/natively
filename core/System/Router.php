<?php

namespace Core\System;

use Exception;

use function PHPSTORM_META\type;

class Router
{
    private App $app;
    private array $actions = [];
    private string $actionKey = "action";
    private string $defaultAction = "home";

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getActionKey(): string
    {
        return $this->actionKey;
    }

    public function getActionList()
    {
        return array_keys($this->actions);
    }

    public function url($action, $queryParams = [])
    {
        if (in_array($action, $this->getActionList()) === false) {
            throw new Exception("Action $action not found");
        }

        $queryParams[$this->actionKey] = $action;

        $query = http_build_query($queryParams);

        return $this->app->config->baseURL . "?" . $query;
    }

    public function pageNotFound(Request $request, Response $response)
    {
        return $response
            ->setStatusCode(404)
            ->body("404: Page Not Found");
    }

    public function handle()
    {
        $get = $_GET;

        if (!isset($get[$this->actionKey]) || !$get[$this->actionKey]) {
            $get[$this->actionKey] = $this->defaultAction;
            $queryString = http_build_query($get);
            header("Location:" . $this->app->config->baseURL . "?" . $queryString);
            exit();
        }

        if (!array_key_exists($get[$this->actionKey], $this->actions)) {
            $this->pageNotFound(new Request($this->app), new Response($this->app));
            exit();
        }

        foreach ($this->actions as $action => $handler) {
            if ($action === $get[$this->actionKey]) {
                $this->runHandler($handler);
                break;
            }
        }
        exit();
    }

    private function runHandler($handler)
    {
        $handlerResult = null;

        if (is_callable($handler)) {
            $handlerResult = $handler(new Request($this->app), new Response($this->app));
        } else {
            if (class_exists($handler)) {
                $classHandler = new $handler;
                if (is_callable($classHandler)) {
                    $handlerResult = $classHandler(new Request($this->app), new Response($this->app));
                } else {
                    throw new Exception("Class " . $handler . " is not callable class. An action class should contain __invoke method.");
                }
            }
        }

        if (
            is_string($handlerResult) ||
            is_numeric($handlerResult) ||
            is_bool($handlerResult)
        ) {
            echo $handlerResult;
        } elseif (is_array($handlerResult)) {
            echo json_encode($handlerResult);
        } elseif (is_object($handlerResult)) {
            echo json_encode($handlerResult);
        }
    }

    protected function setDefaultAction(string $defaultAction)
    {
        $this->defaultAction = urlencode($defaultAction);

        return $this;
    }

    protected function setActionKey(string $actionKey)
    {
        if ($actionKey === "") {
            throw new Exception("Invalid action key");
        }
        $this->actionKey = $actionKey;

        return $this;
    }

    protected function action(string $action, $handler)
    {
        if (preg_match("/^[a-zA-Z0-9_.\-]+$/", $action)) {
            $this->actions = array_merge($this->actions, [$action => $handler]);
        } else {
            throw new Exception("Action: $action is invalid. Only alphanumeric, hyphens, dot, and underscores are allowed.");
        }
    }
}
