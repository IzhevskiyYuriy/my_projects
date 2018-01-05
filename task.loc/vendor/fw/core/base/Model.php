<?php
namespace fw\core\base;

use fw\core\Db;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected $stmt;
    protected $task, $getStatusId, $getId;

    /**
     * @var string id записи в таблицы для получения одной записи
     */
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->primaryKey;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    /**
     * @param $task
     * @param $getStatusId
     * @param $id
     * @param string $table
     * @return array|int
     */
    public function update($task, $getStatusId,  $id, $table = '')
    {
        $table = $table ?: $this->table;
        $this->getId = $id; $this->task = $task; $this->getStatusId = $getStatusId;

        $this->getResultOfComparison();
        $this->MessageShow();

        $sql = "UPDATE {$this->table} SET task = ?, status_id = ? WHERE {$this->table}.id = ?";

        return $this->pdo->queryCount($sql, [$task, $getStatusId, $id]);

    }


    /**
     * @return bool
     */
    public function getResultOfComparison()
    {
        $getData = $this->findOne($this->getId);
        if ($getData[0]['task'] == $this->task && $getData[0]['status_id'] == $this->getStatusId) {return false;}
           return true;
    }

    /**
     * @return string
     */
    public function MessageShow()
    {
        $this->getResultOfComparison() ?  :  MessageSendSuccess(1, 'Вы не внесли изменений, данные сохранены!');
    }

    /**
     * составляет произвольный SQL запрос и возвращает данные в виде массива
     * @param $sql
     * @param array $params
     * @return array
     * example ("SELECT * FROM task ORDER BY id DESC LIMIT 2")
     *          ("SELECT * FROM {$model->table} WHERE task LIKE ?", ['%мним%'])
     */
    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    /**
     * form field names:
     * @param $name
     * @param $email
     * @param $task
     * @param $img
     * @param int $status_id
     * @param string $table
     * @return array|int
     */
    public function insert($name, $email, $task, $img, $status_id = 1, $table = '' )
    {
        $table = $table ?: $this->table;
        $query = "INSERT INTO {$this->table} (name, email, task, status_id, img ) VALUES (?, ?, ?, ?, ?)";

        return $this->pdo->queryCount($query, [$name, $email, $task, $status_id, $img ]);
    }



}