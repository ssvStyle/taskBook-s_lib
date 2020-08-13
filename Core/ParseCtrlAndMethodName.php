<?php

namespace Core;

class ParseCtrlAndMethodName implements \Core\Interfaces\ParseControllerAndMethodNameInterface
{
    /**
     * @var string
     */
    protected $controllerName;
    /**
     * @var string
     */
    protected $methodName;

    public function __construct(string $ctrlAtMethod)
    {
        $ctrlAtMethod = explode('@', $ctrlAtMethod);

        $this->controllerName = $ctrlAtMethod[0];
        $this->methodName = $ctrlAtMethod[1];

    }

    /**
     * @return string
     */
    public function getCtrl()
    {
        return ucfirst($this->controllerName);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->methodName;
    }
}