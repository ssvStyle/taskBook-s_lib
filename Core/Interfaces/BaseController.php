<?php

namespace Core\interfaces;

interface BaseController
{
    public function setData(array $data = []);
    public function access(bool $bool = null);
}