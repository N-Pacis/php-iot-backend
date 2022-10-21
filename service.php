<?php 
    function insert(String $device,String $temperature, $con)
    {
        $data = [
            'device' => $device,
            'temperature' => $temperature
        ];

        $columns = implode(",",array_keys($data));
        $bind_params = implode(', ', array_map(function($value) { return ':' . $value; }, array_keys($data)));

        $query = " INSERT INTO pacis_sensordata ($columns) VALUES ($bind_params);";

        try {

            $statement = $con->prepare($query);
            if($statement->execute($data)) {
                return true;
            }
            return false;
            
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    function findAll($con)
    {
        $statement = " SELECT * FROM pacis_sensordata;";

        try {
            $statement = $con->query($statement);
            return $statement->fetchAll();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
?>