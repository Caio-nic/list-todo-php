<?php

abstract class RouteSwitch
{
    protected function home()
    {
        require __DIR__ . '../pages/listTask.php';
    }

    protected function createScreen()
    {
        require __DIR__ . '../pages/createTask.php';
    }

    protected function editScreen()
    {
        require __DIR__ . '/pages/ceditTask.php';
    }
    
    protected function __call($name, $arguments)
    {
        http_response_code(404);
        require __DIR__ . '/pages/not-found.html';
    }
}