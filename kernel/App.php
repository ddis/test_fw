<?php


namespace kernel;

/**
 * Class App
 *
 * @package kernel
 */
class App
{
    private static $instance = null;
    private        $config   = [];

    /**
     * App constructor.
     */
    private function __construct() { }

    /**
     * Clone method
     */
    private function __clone() { }

    /**
     * Wakeup method
     */
    private function __wakeup() { }

    /**
     * @param array $config
     *
     * @return mixed
     * @throws \Exception
     */
    public static function run(array $config)
    {
        $app = self::getInstance();

        $app->setConfig($config);

        list($function, $params) = Route::getInstance()->run();

        (new $function[0])->{$function[1]}(...$params);
    }

    /**
     * @return App|null
     */
    public static function getInstance(): App
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $name
     *
     * @return array|mixed
     */
    public function getConfig(string $name = '')
    {
        if ($name) {
            return $this->config[$name] ?? [];
        }

        return $this->config;
    }

    /**
     * @param array $config
     *
     * @return App
     */
    private function setConfig(array $config): App
    {
        $this->config = $config;

        return $this;
    }


}
