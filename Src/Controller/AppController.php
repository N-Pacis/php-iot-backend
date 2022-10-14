<?php
namespace Src\Controller;

use Src\ServiceImpls\AppServiceImpl;
use Src\Services\AppService;

class AppController {

    private $db;
    private $requestMethod;

    private AppService $appService;

    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;

        $this->appService = new AppServiceImpl($this->db);
    }

    public function processRequest()
    {
        
        switch ($this->requestMethod) {
            case 'GET':                
                $response = $this->getAllData();
                break;
            case 'POST':
                $response = $this->registerData();
                break;
            case 'OPTIONS':
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllData()
    {
        $result = $this->appService->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function registerData()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $stmt = $this->appService->insert($input['device'],$input['temperature']);
        if($stmt){
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;
        }
        else{
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
            $response['body'] = null;
        }
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}