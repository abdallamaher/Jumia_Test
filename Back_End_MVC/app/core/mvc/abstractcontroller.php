<?php
namespace App\Core\MVC;
use App\Core as Core;


abstract class AbstractController
{

    /**
     * Controller Name
     *
     * @var string
     */
    protected $_controller;

    /**
     * Acion Name
     *
     * @var string
     */
    protected $_action;

    /**
     * Data array used to keep track of
     * all data passed to the view
     *
     * @var array
     */
    protected $_data = array();

    /**
     * URL extracted parameters
     * which could be used for
     * any action
     *
     * @var array
     */
    protected $_params = array();

    
    /**
     * Controller name setter
     *
     * @param string $controller            
     */
    public function setController ($controller)
    {
        $this->_controller = strtolower($controller);
    }

    /**
     * Acion Name setter
     *
     * @param string $action            
     */
    public function setAction ($action)
    {
        $this->_action = strtolower($action);
    }

    /**
     * Parameters array setter
     *
     * @param array $params            
     */
    public function setParams (array $params)
    {
        $this->_params = $params;
    }

    /**
     * Used to get a stored parameter back in a given type
     *
     * @param int $key            
     * @param string $type            
     * @example _getParam(1, 'int');
     * @return mixed
     */
    protected function _getParam ($key, $type)
    {
        if (array_key_exists($key, $this->_params)) {
            $type = strtolower($type);
            $value = '';
            switch ($type) {
                case 'int':
                    $value = filter_var($this->_params[$key],
                            FILTER_SANITIZE_NUMBER_INT);
                    break;
                case 'float':
                    $value = filter_var($this->_params[$key],
                            FILTER_SANITIZE_NUMBER_FLOAT);
                    break;
                case 'string':
                    $value = filter_var($this->_params[$key],
                            FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
                            FILTER_FLAG_NO_ENCODE_QUOTES);
                    break;
            }
            return $value;
        } else {
            return false;
        }
    }

    /**
     * Renders the appropriate view
     * based on the defined controller
     * and action.
     * It users the controller
     * name as a folder name and the action
     * as a reference to the view file name
     */
    protected function _render ()
    {
        extract($this->_data);
        $viewFile = VIEWS_PATH . DS . $this->_controller . DS . $this->_action .
                 '.view.php';
        require_once $viewFile;
    }

    /**
     * Used to render the not found view
     * in case of a non existed view
     */
    public function notfound ()
    {
        $viewFile = VIEWS_PATH . DS . 'notfound' . DS . 'default.view.php';
        require_once $viewFile;
    }

}