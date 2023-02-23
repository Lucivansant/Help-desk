<?php
require_once 'Scripts_API/Curl.php';

class Login_func
{
    public function Get_func_API($email, $senha)
    {
        $API = Api::Get_func($email, $senha);
        return $API;
    }
}

class Login_adm
{
    public function Get_adm_API($email, $senha)
    {
        $API = Api::Get_adm($email, $senha);
        return $API;
    }
}
