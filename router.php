<?php
    require_once __DIR__ . '/RouteSwitch.php';

    class Router extends RouteSwitch
    {
        public function run(string $requestUri)
        {
            $requestUri = str_replace("ccbvilaalpina_novo/", "", $requestUri);
            $route = substr($requestUri, 1);

            if ($route === '') {
                $this->documentation();
            } else {
                $this->$route();
            }
        }
    }
    