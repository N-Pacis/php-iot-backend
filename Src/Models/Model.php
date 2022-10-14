<?php
namespace Src\Models;

class Model {

    private String $deviceName;
    private String $temp;

    public static function initializeValues(String $device, String $temperature) {
        $instance = new self();

        $instance->deviceName = $device;
        $instance->temp = $temperature;

        return $instance;
    }


    public function getDeviceName()
    {
        return $this->deviceName;
    }
    public function getTemp()
    {
        return $this->temp;
    }   

    public function setDeviceName(String $deviceName)
    {
        $this->deviceName = $deviceName;
    }
    public function setTemp(String $temp)
    {
        $this->temp = $temp;
    }
   
   
}