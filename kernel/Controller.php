<?php


namespace kernel;

/**
 * Class Controller
 *
 * @package kernel
 */
class Controller
{
    protected $view   = null;
    public    $layout = 'main';

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new Template();
    }

    /**
     * @param string $name
     * @param array  $data
     *
     * @return mixed
     */
    public function render(string $name, array $data = [])
    {
        $content = $this->renderFile($name, $data);

        return include_once "{$this->view->getTmplDir()}/layouts/{$this->layout}.php";
    }

    /**
     * @param string $name
     * @param array  $data
     *
     * @return false|string
     */
    public function renderFile(string $name, array $data = [])
    {
        return $this->view->display($name, $data);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function renderJson(array $data)
    {
        echo json_encode($data);
    }
}
