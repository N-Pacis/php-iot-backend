<?php    
    require "./service.php";

    function registerData($dbConnection)
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $stmt = insert($input['device'],$input['temperature'], $dbConnection);
        if($stmt){
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;
        }
        else{
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
            $response['body'] = null;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
?>