<?php
    abstract class RouteSwitch
    {
        protected function documentation()
        {
            require __DIR__ . '/docs/documentation.html';
        }

        protected function login()
        {
            require __DIR__ . '/pages/login.php';
        }

        protected function home()
        {
            require __DIR__ . '/examples/home.html';
        }

        protected function dashboard()
        {
            require __DIR__ . '/examples/dashboard.html';
        }

        protected function tables()
        {
            require __DIR__ . '/examples/tables.html';
        }
        
        protected function __call($name, $arguments)
        {
            http_response_code(404);
            require __DIR__ . '/pages/not-found.html';
        }
    }
    