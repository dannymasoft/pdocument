<?php
class ProcesosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }

    public function index(){

        $this->View("Procesos",array());
        
    }

}
?>