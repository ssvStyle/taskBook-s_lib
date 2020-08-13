<?php

namespace Core\Interfaces;

interface RouterInterface
{

    public function __construct(string $request);

    public function getParams();

    public function response();

}