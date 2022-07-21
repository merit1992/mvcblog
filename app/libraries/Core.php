<?php

class Core {
    protected $currentController = 'pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();
        // check in the controller for the first value. ucwords will capitalize the first letter
        if (file_exists('../app/controllers/'. ucwords($url[0]). '.php')) {
            // setting a new controller and override 'pages'
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        // require the file from the controllers folder
        require_once '../app/controllers/'. $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        // check for the second part of the url

        if (isset($url[1])) {
            if (method_exists($this->currentController ,$url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]); 
            }
        }
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    public function getUrl() {
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');

            $url = filter_var($url, FILTER_SANITIZE_URL);

            $url = explode('/', $url);
            return $url;
        }
    }
}