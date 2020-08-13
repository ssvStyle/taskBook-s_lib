<?php

namespace Core\Interfaces;

interface ParseControllerAndMethodNameInterface
{
    public function __construct(string $ctrlAtMethod);

    /**
     * @return string
     */
    public function getCtrl();

    /**
     * @return string
     */
    public function getMethod();

}