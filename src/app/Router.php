<?php

namespace App;

use Exception;

class Router
{
    private $root_directory;

    public $route;
    public $namespace;
    public $controller;
    public $method;

    public function __construct($root_directory)
    {
        $this->root_directory = $root_directory;
        $this->route = $this->explodeURI();

        $this->namespace = $this->setNamespace();
        $this->controller = $this->setController();
        $this->method = $this->setMethod();
    }

    private function explodeURI()
    {
        $request_uri = explode('/', $_SERVER['REQUEST_URI']);
        $request_uri = array_diff($request_uri, ['', null, 0, $this->root_directory]);
        $regex_xml = '/^([a-z]+).([xml]{3})$/';
        $regex_get = '/^(&|\?)([a-z]+)=([0-9]+)$/';

        if (!empty($request_uri)) {
            $i = 0;
            foreach ($request_uri as $k => $v) {
                if (preg_match($regex_get, $request_uri[$k])) {
                    $route[$i] = $request_uri[$k]; 
                }
                elseif(preg_match($regex_xml, $request_uri[$k]))
                {
                    header('Content-Type: application/xml; charset=utf-8');
                    require($request_uri[$k]);
                    exit();
                }
                else 
                {
                    $route[$i] = $request_uri[$k];
                    $i++;
                }  
            }
        }
        else
        {
            $route = $request_uri;
        }

        return $route;
    }

    public function init()
    {
        $controller = $this->getController();
        $method = $this->getMethod();

        try
        {
            if (class_exists($controller) && method_exists($controller, $method)) {
                $controller = new $controller;
                $controller->$method();
            } else {
                header('Location: /portofolio/error/notfound/');
                throw new \Exception('Controller or method not found');;
            }

        }
        catch(\Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
            
        
    }

    public function getController()
    {
        $controller = $this->namespace . '\\' . $this->controller;
        return $controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setNamespace()
    {

        if (isset($this->route['0']) && $this->route['0'] === 'admin') {
            $namespace = '\App\Controller\Admin';
        } else {
            $namespace = '\App\Controller';
        }
        return $namespace;
    }

    public function setController()
    {
        $regex = '/^(&|\?)([a-z]+)=([0-9]+)$/';
        if (isset($this->route['0'])) {
            if ($this->route['0'] === 'admin') {
                if (isset($this->route['1'])) {
                    $controller = $this->route['1'];
                } else {
                    $controller = 'post';
                }
            }
            elseif(preg_match($regex, $this->route['0']))
            {
                $controller = 'post';
            }
            else 
            {
                $controller = $this->route['0'];
            }
        } else {
            $controller = 'post';
        }
        $controller = ucfirst($controller) . 'Controller';
        return $controller;
    }

    public function setMethod()
    {
        if (isset($this->route['0']) && $this->route['0'] === 'admin') {
            if (isset($this->route['1'])) {
                if (isset($this->route['2'])) {
                    $method = $this->route['2'];
                } else {
                    $method = 'index';
                }
            } else {
                $method = 'index';
            }
        } else {
            if (isset($this->route['0'])) {
                if (isset($this->route['1'])) {
                    $method = $this->route['1'];
                } else {
                    $method = 'index';
                }
            } else {
                $method = 'index';
            }
        }
        return $method;
    }
}
