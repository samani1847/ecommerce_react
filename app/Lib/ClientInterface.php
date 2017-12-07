<?php
namespace App\Lib;


interface ClientInterface{

    public function login($username, $password);
}