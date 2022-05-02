<?php
namespace App\Core;

use App\Core as Core;


class FrontController 
{
    
    const DEFAULT_CONTROLLER   = 'index';
    const DEFAULT_ACTION       = 'default';
    const CONTROLLER_NOT_FOUND = 'notfound';
    
    private $_controller;
    private $_action;
    private $_params = array();
    
    public function __construct()
    {
        $this->_parseUrl();
    }
    
    private function _parseUrl()
    {
        // TODO:: AVOID NOTICES HERE
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        @list($controller, $action, $params) = explode('/', $url, 3);
        
        if(isset($controller) && !empty($controller)) {
            $this->_controller = strtolower($controller);
        } else {
            $this->_controller = self::DEFAULT_CONTROLLER;
        }
        
        if(isset($action) && !empty($action)) {
            $this->_action = strtolower($action);
        } else {
            $this->_action = self::DEFAULT_ACTION;
        }
        
        if(isset($params) && !empty($params)) {
            $this->_params = explode('/', $params);
        } else {
            $this->_params = array();
        }
    }
    
    public function dispatch()
    {
        $class = ucfirst(strtolower($this->_controller)) . 'Controller';
        $fileToRequire = CONTROLLERS_PATH . DS . $this->_controller . 'controller.php';
        if(!file_exists($fileToRequire) || !is_readable($fileToRequire)) {
            $this->_controller = self::CONTROLLER_NOT_FOUND;
            $this->_action = self::DEFAULT_ACTION;
            $class = ucfirst(strtolower($this->_controller)) . 'Controller';
        }
        $className = '\App\Controllers' . '\\' . $class;
        $contol = new $className ();
        $contol->setController($this->_controller);
        $contol->setAction($this->_action);
        $contol->setParams($this->_params);
        $method = strtolower($this->_action) . 'Action';
        if(method_exists($contol, $method)) {
            $contol->$method();
        } else {
            $contol = new \App\Controllers\NotFoundController;
            $contol->setController($this->_controller);
            $contol->setAction($this->_action);
            $contol->setParams($this->_params);
            $contol->defaultAction();
        }
    }
}