<?php
namespace fw\core;

interface BasicMethods {
    
    /**
     * добавляет маршрут в таблицу маршрутов  
     * @param string $regexp регулярные выражения маршрута
     * @param array $route маршрут ([controller, action, params])
     */
    public static function addRoutes($regexp, array $route = []);
    
    /**
     * возвращает таблицу маршрутов 
     * @return array 
     */
    public static function getRoutes();
    
    /**
     * возвращает текущий маршрут ([controller, action, params])
     * @return array 
     */
    public static function getRoute();
    
    /**
     * ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return boolean
     */
    public static function matchRoute($url);
    
    /**
     * перенаправляет URL по коректному маршруту 
     * @param string $url входящий URL
     * @return void
     */
    public static function dispatch($url);
    
    /**
     * устанавлеваит правильный синтакис для имени контроллера 
     * @param string $nameClass передаваемое имя класса - контроллера
     * example post-new/test -- PostNewController::testAction
     * @return string
     */
    public static function upperCamelCase($nameClass);
    
    /**
     * устанавлеваит правильный синтакис для имени метода - экшена 
     * @param string $nameAction передаваемое имя метода - экшена
     * example post-new/test -- PostNewController::testAction
     * @return string
     */
    public static function lowerCamelCase($nameAction);
    
    /**
     * обрезает неявные get параметры
     * @param string $url передаваемые get параметры 
     * @return string $url| void
     */
    public static function removeQueryString($url);
}
