<?php

namespace App\Controllers;

use App\Models\TodoModel;
use App\Requests\Request;

class TodoController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new TodoModel();
    }

    public function index()
    {
        $tasks = $this->model->getAllTasks();

        return $this->render('home', ['tasks' => $tasks]);
    }    

    public function store(Request $request)
    {
        $data = $request->all();
        $save = $this->model->addTask($data['task']);

        $this->redirect();
    }

    public function update(Request $request, int $id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $update = $this->model->updateTask($id, $data['task'], $data['position'], $data['checked']);
    
        if ($update) {
            $response = ['status' => 'success', 'message' => 'Task updated successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Task update failed'];
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }    

    public function destroy(Request $request, int $id)
    {
        $delete = $this->model->deleteTask($id);
    
        if ($delete) {
            $response = ['status' => 'success', 'message' => 'Task deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Task deletion failed'];
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
       
}
