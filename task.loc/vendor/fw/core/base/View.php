<?php

namespace fw\core\base;


class View
{
    /**
    * текущий маршрут и параметры (controller, action, params)
    * @var array
    */
    public $route = [];

    /**
     * текущий вид
     * он будет браться из $route = [], если его пользователь не определил или не переопределил
     * @var string
     */
    public $view;

    /**
     * текущий шаблон
     * он будет по умолчанию если его пользователь не определил или не переопределил
     * @var string
     */
    public $layout;

    /**
     * вызывается автоматически, в котором подключаются view, layout и $переменные
     * и он доступен из Контроллера, для подключения
     */
     public function __construct($route, $layout = '',  $view = '')
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }

        $this->view = $view;

    }

    public function render($vars)
    {
        if (is_array($vars)) extract($vars);

        $fileView = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();

        if (is_file($fileView)) {
            require $fileView;
        } else {
            echo "<p>Не найден вид <b></b>{$fileView}</p>";
        }
        $content = ob_get_clean();

        if (false !== $this->layout) {
            $fileLayout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($fileLayout)) {
                require $fileLayout;
            } else {
                echo "<p>Не найден  шаблон <b></b>{$fileLayout}</p>";
            }
        }
    }


}