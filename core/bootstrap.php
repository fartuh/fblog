<?php

class Bootstrap
{
    public $url, $routes;

    public function __construct($url, $routes){
        $this->url = $url;
        $this->routes = json_decode($routes, true);
    }

    public function route(){
        $routed = false;

        foreach($this->routes as $route => $page){
            if($this->url == $route){
                $this->load($page); 
                $routed = true;
            }
        }

        if(!$routed){
            $this->load('404');
        }
    }

    private function load($page, $view = 'view'){
        $data = json_decode(file_get_contents('data/pages/' . $page . '.json'), true);

        foreach($data as $key => $value){
            $$key = $value;
        }
        require("app/$view.php");
    }
}
