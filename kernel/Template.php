<?php


namespace kernel;

/**
 * Class Template
 *
 * @package kernel
 */
class Template
{
    private $dir_tmpl = __DIR__ . "/../app/views/";
    public  $title    = '';

    /**
     * @return string
     */
    public function getTmplDir()
    {
        return $this->dir_tmpl;
    }

    /**
     * @param $template
     * @param $data
     *
     * @return false|string
     */
    public function display($template, $data)
    {
        $template = $this->dir_tmpl . $template . ".php";
        ob_start();
        extract($data);
        include($template);

        $data = ob_get_contents();
        ob_get_clean();

        return $data;
    }
}

