<?php
declare(strict_types=1);
class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        $path = explode('/', filter_var(rtrim(substr($url['path'], 1), '/'), FILTER_SANITIZE_URL));
        if(file_exists('../mailbot_microservice/controllers/'. $path[1] .'.php'))
        {
            $this->controller = $path[1];
            unset($path[1]);
        }
        require_once '../mailbot_microservice/controllers/'. $this->controller. '.php';
        $this->controller = new $this->controller;
        
        if(isset($path[2]))
        {
            if(method_exists($this->controller, $path[2]))
            {
                $this->method = $path[2];
                unset($path[2]);
            }
        }
        if(isset($url['query']))
           parse_str($url['query'], $this->params);
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
           $url = "https://";
        else
           $url = "http://";
        // Append the host(domain name, ip) to the URL.
        $url.= $_SERVER['HTTP_HOST'];
        // Append the requested resource location to the URL
        $url.= $_SERVER['REQUEST_URI'];
        $adresaWeb = parse_url($url);
        return $adresaWeb;
    }
}
?>