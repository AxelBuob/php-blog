<?php

namespace Core\Controller;

use Core\Auth\Auth;
use Core\Database\MysqlDatabase;
use Core\Config;


class Controller
{
    protected $viewPath;
    protected $template;
    protected $auth;
    protected $title;
    protected $db;
    protected $config;

    public function __construct()
    {
        $this->auth = new Auth;
        $this->loadModel('site');
        $this->loadModel('user');
    }

    protected function render($view, $variables = [], $title = null)
    {
        ob_start();
        extract($variables);
        $auth = $this->auth->logged();
        $admin = $this->auth->isAdmin();
        $config = $this->getConfig();
        $title = ($title) ? $title  : $this->title;
        require($this->viewPath . str_replace('.','/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . "template/" .$this->template . '.php');
    }

    protected function getDB()
    {
        $config = Config::getConfig(ROOT . '/config/config.php');
        if ($this->db === null) {
            $this->db = new MysqlDatabase($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_pass'));
        }
        return $this->db;
    }

    public function getLastId()
    {
        return $this->getDB()->lastInsertId();
    }

    protected function getConfig()
    {
        return $this->site->find('1');
        
    }

    protected function setTitle($title)
    {
        $this->title = $title;
    }

    protected function getTitle()
    {
        return $this->title;
    }

    protected function getModel($name = null)
    {
        $class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDB());
    }

    protected function loadModel($model)
    {
        $this->$model = $this->getModel($model);
    }
}