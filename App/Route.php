<?php

class Route
{
    protected $app;
    protected $defaultAction = "home";

    public $actions = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function setDefaultAction($defaultAction)
    {
        $this->defaultAction = $defaultAction;
    }

    public function action(string $action, callable $handler)
    {
        $this->actions = array_merge($this->actions, [$action => $handler]);
    }

    public function handle()
    {
        $get = $_GET;

        if (!isset($get["nact"]) || !$get["nact"]) {
            header("Location:" . $this->app->config->baseUrl . "?nact=" . $this->defaultAction);
            exit();
        }

        if (!array_key_exists($get["nact"], $this->actions)) {
            echo "Not found";
            exit();
        }

        foreach ($this->actions as $action => $handler) {
            if ($action === $get["nact"]) {

                $req = new Request($this->app);
                $res = new Response($this->app);

                $handler($req, $res);
                break;
            }
        }
    }

    public function url($action, $queryParams = [])
    {
        $queryParams["nact"] = $action;

        $query = http_build_query($queryParams);

        return $this->app->config->baseUrl . "?" . $query;
    }

    public function redirect($action, $queryParams = [])
    {
        $url = $this->url($action, $queryParams);
        header("Location:" . $url);
        exit();
    }
}
