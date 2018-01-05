<?php

namespace fw\core;

class Db
{
    protected $pdo;
    protected static $instance;

    static $countSql = 0;

    /**
     * @var array записывает все SQL запросы
     */
     static $querySql = [];

    /**
     * Db constructor.
     */
     protected function __construct()
     {
         $db = require ROOT . '/config/config_db.php';
         $options = [
             \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
             \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
         ];
         $this->pdo = new \PDO($db['dns'], $db['user'], $db['password'], $options );
     }

    /**
     * @return Db
     */
     public static function instance()
     {
         if (self::$instance === null) {
             self::$instance = new self; //записываем объкт данного класса
         }
         return self::$instance;
     }

     private function __clone()
     {

     }

     private function __wakeup()
     {

     }

    /**
     * PDO::prepare — Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
     *      prepare() - Выполнение запроса с передачей ему массива параметров
     * http://php.net/manual/ru/pdo.prepare.php
     * @param $sql
     * @param array $params
     * @return bool
     * Пример: создание БД или обновления (вернет tru || false)
     */
    public function execute($sql, $params = [])
     {
         self::$countSql++;
         self::$querySql[] = $sql;
         $stmt = $this->pdo->prepare($sql);
         return $stmt->execute($params);
     }

     /**
     * Принисает параметрами SQL запрос и возвращает его
     * @param $sql
     * @param array $params
     * @return array
     * SELECT ...
     */
     public function query($sql, $params = [])
     {
         $this->countQuery($sql);

         $stmt = $this->pdo->prepare($sql);
         $result = $stmt->execute($params);
         if ($result !== false) {
             return $stmt->fetchAll(\PDO::FETCH_ASSOC);
         }
         return [];
     }

    public function queryCount($sql, $params = [])
    {
        $this->countQuery($sql);

        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);

        if ($result !== false) {
            return $stmt->rowCount();
        }
        return [];
    }

    public function countQuery($sql)
    {
        return [
            self::$countSql++,
            self::$querySql[] = $sql
        ];
    }






}