<?php

namespace Core;

class Router implements \Core\Interfaces\RouterInterface
{
    protected $routeMap;
    
    protected $request;

    protected $parseRoute;

    public function __construct(string $request)
    {
        $this->request = $request;
        
        $this->routeMap = include __DIR__ . '/../routes/web.php';

        $this->parseRoute = new ParseRoute();


    }

    public function getParams()
    {
        //
    }

    public function response()
    {
        $rez = [];

        $patternGetParams = '~([?]\w*[=]\w*).+~';

        $request = preg_replace($patternGetParams, '', $this->request);

        $request = preg_replace('~^\/[\w\-\.\+\?\#]*~', '', $request);

        $request = preg_replace('~\/$~', '', $request);

        if ( empty( $request ) ) {

            $request = '/';

        }


        foreach ($this->routeMap as $route => $ctrlAtMethod) {


            if (preg_match($this->parseRoute->getRegexpFromRoute($route), $request, $params)) {

                $args = [];

                foreach ($params as $k => $v) {
                    if (!is_numeric($k)) {
                        $args[$k] = $v;
                    }
                }

                $rez['ctrlAtMethod'] = $ctrlAtMethod;
                $rez['args'] = $args;

            }
        }


        return $rez;
    }
}