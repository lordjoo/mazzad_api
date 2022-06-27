<?php

namespace App\Helpers;

use Illuminate\Routing\ResponseFactory;

class ApiResponse
{

    /**
     * @var ResponseFactory
     */
    private $response;

    /**
     * @var int
     */
    private $status;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $message;
    /**
     * @var null
     */
    private $error;
    /**
     * @var null
     */
    private $pagination;

    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
        $this->status = 200;
        $this->data = [];
        $this->error = null;
        $this->pagination = null;
        $this->message = "";
    }

    public function success($message = "",$data = [])
    {
        $this->message = $message;
        $this->status = 200;
        $this->data = $data;
        return $this;
    }

    public function error($message = "",$statusCode = 500): ApiResponse
    {
        $this->message = $message;
        $this->status = $statusCode;
        return $this;
    }

    /**
     * @param $code integer
     */
    public function setStatusCode(int $code): ApiResponse
    {
        $this->status = $code;
        return $this;
    }

    /**
     * @param $data array | object
     */
    public function setData($data): ApiResponse
    {
        $this->data =  $data;
        return $this;
    }

    /**
     * @param $message string
     */
    public function setMessage(string $message): ApiResponse
    {
        $this->message = $message;
        return $this;
    }

    public function setError(array $array): ApiResponse
    {
        $this->error = $array;
        return $this;
    }

    public function setPagination(array $array): ApiResponse
    {
        $this->pagination = $array;
        return $this;
    }


    public function return(): \Illuminate\Http\JsonResponse
    {
        $returnedArray = [
            "status" => $this->status == 200,
            "message"   => $this->message,
            "data"      => $this->data
        ];
        if (is_array($this->error)) {
            $returnedArray["error"] = $this->error;
        }
        return $this->response->json(
            $returnedArray,
            $this->status
        );
    }


}
