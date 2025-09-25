<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;


class Core
{
    public static function dispatch(array $routes)
    {

        
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];

        $url !== '/' && $url = rtrim($url, '/');

        $prefixController = 'App\\Controllers\\';

        $routeFound = false;

        foreach ($routes as $route)
        {

            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

            

            if (preg_match($pattern, $url, $matches))
            {
             
                array_shift($matches);

                $routeFound = true;

                //echo $route['method'], "----"; echo Request::method(); echo "----",$_GET['url'];

                if ($route['method'] !== Request::method())
                {

                    Response::json([
                        'error'   => true,
                        'success' => false,
                        'message' => 'Método não permitido.'
                    ],405);
                    return;
                }

                [$controller, $action] = explode('@', $route['action']);

                $controller = $prefixController . $controller;

                //echo $controller;

                $extendController = new $controller();
                $extendController->$action(new Request, new Response, $matches);

                //print_r($matches);


                
            }

        }

        if (!$routeFound)
        {
            $controller = $prefixController . 'NotFoundController';
            $extendController = new $controller();
            $extendController->index(new Request, new Response);
        }
    }
}