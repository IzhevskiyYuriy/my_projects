<?php

namespace fw\core;

class Router implements BasicMethods
{
    /**
     * содержит массив маршрутов.
     * @var array
     */
    protected static $routes = [];
    /**
     * содержит текущий массив маршрутов.
     * @var array
     */
    protected static $route = [];
    
    /**
     * добавляет маршрут в таблицу маршрутов  
     * @param string $regexp регулярные выражения маршрута
     * @param array $route маршрут ([controller, action, params])
     */
    public static function addRoutes($regexp, array $route = [])
    {
        self::$routes[$regexp] = $route;
    }
    
    /**
     * возвращает таблицу маршрутов 
     * @return array 
     */
    public static function getRoutes() 
    {
        return self::$routes;
    }
    
    /**
     * возвращает текущий маршрут ([controller, action, params])
     * @return array 
     */
    public static function getRoute() 
    {
        return self::$route;
    }
    
    /**
     * ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return boolean
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) $route[$key] = $value;
                }
                if (!isset($route['action'])) $route['action'] = 'index';
                $route['controller'] =  self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    
    /**
     * перенаправляет URL по корректному маршруту
     * @param string $url входящий URL
     * @return void
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $objController = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action'] . 'Action');
                if(method_exists($objController, $action)) {
                    $objController->$action();
                    $objController->getView();
                } else {
                    redirect('/');
                  //  echo "Метод <b>$controller::$action</b> не найден";
                }
            } else {
                redirect('/');
               //echo "Контроллер <b>$controller</b> не найден либо допущена ощибка в имени";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }
    
    /**
     * устанавлеваит правильный синтакис для имени контроллера 
     * @param string $nameClass передаваемое имя класса - контроллера
     * example post-new/test -- PostNewController::testAction
     * @return string
     */
    public static function upperCamelCase($nameClass)
    {
        $nameClass = str_replace('-', ' ', $nameClass);
        $nameClass = ucwords($nameClass);
        $nameClass = str_replace(' ', '', $nameClass);
        return $nameClass;
       
    }
    
    /**
     * устанавлеваит правильный синтакис для имени метода - экшена 
     * @param string $nameAction передаваемое имя метода - экшена
     * example post-new/test-post -- PostNewController::testPostAction
     * @return string
     */
    public static function lowerCamelCase($nameAction)
    {
       return lcfirst(self::upperCamelCase($nameAction));
    }
    
    /**
     * обрезает неявные get параметры
     * @param string $url передаваемые get параметры 
     * @return string $url| void
     */
    public static function removeQueryString($url)
    {
        if ($url){
            $params = explode('&', $url);
            if (strpos($params[0], '=') === false) {
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }
    }
   
    
    
}
