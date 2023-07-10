<?php

namespace App\Requests;

class Request
{
    private $get;
    private $post;
    private $put;
    private $delete;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        parse_str(file_get_contents("php://input"), $this->put);
        parse_str(file_get_contents("php://input"), $this->delete);
    }

    public function get($key = null)
    {
        if ($key) {
            return $this->get[$key] ?? null;
        }

        return $this->get;
    }

    public function post($key = null)
    {
        if ($key) {
            return $this->post[$key] ?? null;
        }

        return $this->post;
    }

    public function put($key = null)
    {
        if ($key) {
            return $this->put[$key] ?? null;
        }

        return $this->put;
    }

    public function delete($key = null)
    {
        if ($key) {
            return $this->delete[$key] ?? null;
        }

        return $this->delete;
    }

    public function all()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        switch($method) {
            case 'GET':
                return $this->get;
            case 'POST':
                return $this->post;
            case 'PUT':
                return $this->put;
            case 'DELETE':
                return $this->delete;
            default:
                return null;
        }
    }
}
