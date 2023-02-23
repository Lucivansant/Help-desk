<?php
class Api
{
    public static function Get_func($email, $senha)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:7000/v1/Login_func',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'email' => $email,
                'senha' => $senha
            ]
        ]);

        $Response = curl_exec($curl);

        return $Response;

        curl_close($curl);
    }

    public static function Get_adm($email, $senha)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:7000/v1/Login_adm',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'email' => $email,
                'senha' => $senha
            ]
        ]);

        $Response = curl_exec($curl);

        return $Response;

        curl_close($curl);
    }
}
