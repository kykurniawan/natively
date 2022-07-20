<?php

namespace Core;

class Route
{
    private array $actions = [];
    private string $actionKey = "action";
    private string $defaultAction = "home";
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    protected function setDefaultAction(string $defaultAction): Route
    {
        $this->defaultAction = $defaultAction;

        return $this;
    }

    protected function setActionKey(string $actionKey): Route
    {
        $this->actionKey = $actionKey;
        return $this;
    }

    protected function action(string $action, callable $handler)
    {
        $this->actions = array_merge($this->actions, [$action => $handler]);
    }

    public function getActionKey(): string
    {
        return $this->actionKey;
    }

    public function url($action, $queryParams = [])
    {
        $queryParams[$this->actionKey] = $action;

        $query = http_build_query($queryParams);

        return $this->app->getBaseURL() . "?" . $query;
    }

    public function redirect($action, $queryParams = [])
    {
        $url = $this->url($action, $queryParams);
        header("Location:" . $url);
        exit();
    }

    public function handle()
    {
        $get = $_GET;

        if (!isset($get[$this->actionKey]) || !$get[$this->actionKey]) {
            header("Location:" . $this->app->getBaseURL() . "?" . $this->actionKey . "=" . $this->defaultAction);
            exit();
        }

        if (!array_key_exists($get[$this->actionKey], $this->actions)) {
            echo "Action not found!";
            exit();
        }

        foreach ($this->actions as $action => $handler) {
            if ($action === $get[$this->actionKey]) {
                $handler(new Request($this->app), new Response());
                break;
            }
        }
    }
}
