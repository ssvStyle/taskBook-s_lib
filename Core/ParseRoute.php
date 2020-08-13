<?php

namespace Core;

class ParseRoute implements \Core\Interfaces\ParseRouteInterface
{
     /**
     *
     * @return string
     */
    public function getRegexpFromRoute(string $route)
    {
        $route = explode('/', $route);

        foreach ($route as $k => $name) {

            if (preg_match('~\{\w*\}~', $name)){

                $name = preg_replace('~\{|\}~', '', $name);
                $route[$k] = preg_replace('~'.$name.'~', '(?<' . $name . '>(\w*))', $name);

            }
        }

        $route = implode('\/', $route);

        return ('~^' . $route . '$~');
    }
}