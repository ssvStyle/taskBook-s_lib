<?php

namespace App;
/**
 * Class View
 * @package App
 *
 * @property Array $data
 */
class View
{

    protected $data = [];

    /**
     * @param $template name of view file
     *
     *
     * @return string
     */
    public function render($template)
    {
        ob_start();

        extract($this->data);

        include __DIR__ . '/../templates/' . $template . '.php';

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    public function withParams(string $varName, $data)
    {
        $this->data[$varName] = $data;

        return $this;
    }

}