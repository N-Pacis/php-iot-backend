<?php

namespace Src\ServiceImpls;

use Src\Models\Model;
use Src\Services\AppService;

class AppServiceImpl implements AppService
{

    private $db = null;

    public function __construct($dbconnection)
    {
        $this->db = $dbconnection;
    }

    public function findAll()
    {
        $statement = " SELECT * FROM pacis_sensordata;";

        try {
            $statement = $this->db->query($statement);
            $statement->setFetchMode(\PDO::FETCH_CLASS,"Src\Models\Model");
            return $statement->fetchAll();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find(int $id)
    {
        $statement = "SELECT * FROM pacis_sensordata WHERE id = ?;";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $statement->setFetchMode(\PDO::FETCH_CLASS,"Src\Models\Model");
            return $statement->fetch();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function findByDevice(String $device)
    {
        $statement = "SELECT * FROM pacis_sensordata WHERE device = :DEVICE;";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('DEVICE' => $device));
            $statement->setFetchMode(\PDO::FETCH_CLASS,"Src\Models\Model");
            return $statement->fetch();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(String $device,String $temperature)
    {
        $data = [
            'device' => $device,
            'temperature' => $temperature
        ];

        $columns = implode(",",array_keys($data));
        $bind_params = implode(', ', array_map(function($value) { return ':' . $value; }, array_keys($data)));

        $query = " INSERT INTO pacis_sensordata ($columns) VALUES ($bind_params);";

        try {

            $statement = $this->db->prepare($query);
            if($statement->execute($data)) {
                return true;
            }
            return false;
            
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete(int $id)
    {
        $statement = "DELETE FROM pacis_sensordata WHERE id = :id;";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
