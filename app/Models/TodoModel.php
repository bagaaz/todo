<?php

namespace App\Models;

use PDO;

class TodoModel extends Model
{
    protected $tableName = 'tasks';

    public function getAllTasks()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tableName} ORDER BY position ASC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask(string $task)
    {
        $stmt = $this->db->prepare("SELECT MAX(position) as max_position FROM {$this->tableName}");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $newPosition = ($result['max_position'] !== null) ? $result['max_position'] + 1 : 1;

        $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (task, position) VALUES (?, ?)");
        return $this->executeQuery($stmt, [$task, $newPosition], 'add');
    }

    public function updateTask(int $id, string $task, int $position, int $checked)
    {
        $stmt = $this->db->prepare("UPDATE {$this->tableName} SET task = ?, position = ?, checked = ? WHERE id = ?");
        return $this->executeQuery($stmt, [$task, $position, $checked, $id], 'update');
    }

    public function deleteTask(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        return $this->executeQuery($stmt, [$id], 'delete');
    }

    private function executeQuery($stmt, $params, $operation) {
        $success = ['add' => 'Tarefa adicionada com sucesso!', 
                    'update' => 'Tarefa atualizada com sucesso!', 
                    'delete' => 'Tarefa excluída com sucesso!'];
                    
        $failure = ['add' => 'Oops, houve um erro ao adicionar a tarefa!', 
                    'update' => 'Oops, houve um erro ao atualizar a tarefa!', 
                    'delete' => 'Oops, houve um erro ao excluir a tarefa!'];

        return ($stmt->execute($params)) ? $success[$operation] : $failure[$operation];
    }
}
