<?php

namespace App\Http\Controllers;

abstract class CrudController extends Controller
{
    protected $viewName = null;

    protected function renderIndex($parameters = array()) {
        return $this->render($this->viewName . "/index", $parameters);
    }

    protected function renderCreate($parameters = array()) {
        return $this->render($this->viewName . "/create", $parameters);
    }
    
    protected function renderEdit($parameters = array()) {
        return $this->render($this->viewName . "/edit", $parameters);
    }
  
}
