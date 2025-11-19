<?php

namespace Models;

use Exception;
use PDO;

class Task extends Database
{
    protected $name;
    // protected $checked = false;
    protected $type;

    public function setNameTask($value)
    {
        $this->name = $value;
    }
    public function getNameTask()
    {
        return $this->name;
    }
    // public function setCheckTask($value)
    // {
    //     $this->checked = $value;
    // }
    // public function getCheckTask()
    // {
    //     return $this->checked;
    // }
    public function setTypeTask($value)
    {
        $this->type = $value;
    }
    public function getTypeTask()
    {
        return $this->type;
    }

    public function createTask()
    {
        $queryExecute = $this->db->prepare("INSERT INTO `tasks`(`name`) 
			VALUES (:name)");

        $queryExecute->bindValue(':name', $this->name, PDO::PARAM_STR);

        return $queryExecute->execute();
    }
    public function modifTask($id)
    {
        $queryExecute = $this->db->prepare("UPDATE `tasks` 
			SET `name`=:name WHERE `id`=:id");

        $queryExecute->bindValue(':id', $id, PDO::PARAM_INT);

        return $queryExecute->execute();
    }
    public function deleteTask($id)
    {
        $queryExecute = $this->db->prepare("DELETE FROM `tasks` 
         WHERE `id`=:id");
        $queryExecute->bindValue(':id', $id, PDO::PARAM_INT);

        return $queryExecute->execute();
    }
    public function checkedTask($id, $checked)
    {
        $queryExecute = $this->db->prepare("UPDATE `tasks` 
			SET `checked`=:checked WHERE `id`=:id");

        $queryExecute->bindValue(':checked', $checked, PDO::PARAM_INT);
        $queryExecute->bindValue(':id', $id, PDO::PARAM_INT);

        return $queryExecute->execute();
    }
}
