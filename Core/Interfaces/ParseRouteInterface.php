<?php

namespace Core\Interfaces;

interface ParseRouteInterface
{

    /**
     *
     * @return string
     */
    public function getRegexpFromRoute(string $route);

}