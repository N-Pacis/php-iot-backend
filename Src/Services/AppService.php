<?php

namespace Src\Services;

interface AppService
{

    public function findAll();

    public function find(int $id);

    public function findByDevice(String $device);

    public function insert(String $device,String $temperature);

    public function delete(int $id);
}