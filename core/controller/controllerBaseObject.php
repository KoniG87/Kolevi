<?php
class BaseObject{
    private $dbHandler;
    protected $view;
    protected $objectType;
    
    function __construct($dbHandler){
        $this->dbHandler = $dbHandler;
        $view = null;
        
        $this->initView();
    }
    
    function initView(){
        $viewName = $this->objectType.'View';
        $this->view = new $viewName();        
    }
    
    
    
}
?>