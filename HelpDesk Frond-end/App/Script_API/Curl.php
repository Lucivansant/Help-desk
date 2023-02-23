<?php
class Api
{
    public static function Registra_chamado($titulo, $opt_setor, $opt_categoria, $desc, $status, $funcionario)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:7000/v1/Registra_chamado',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'titulo' => $titulo,
                'opt_setor' => $opt_setor,
                'opt_categoria' => $opt_categoria,
                'desc' => $desc,
                'status' => $status,
                'funcionario' => $funcionario
            ]
        ]);

        $Response = curl_exec($curl);

        return $Response;

        curl_close($curl);
    }

    public static function Recuperar_registros($funcionario)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:7000/v1/Seleciona_individual_chamado',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'funcionario' => $funcionario
            ]
        ]);

        $Response = curl_exec($curl);

        return $Response;

        curl_close($curl);
    }
    public static function Recuperar_todos_registros()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:7000/v1/Seleciona_todos_chamado',
            CURLOPT_RETURNTRANSFER => true
        ]);

        $Response = curl_exec($curl);

        return $Response;

        curl_close($curl);
    }

    public static function Atualizar_status($status_chamado, $id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:7000/v1/Atualiza_chamado',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'status' => $status_chamado,
                'id' => $id
            ]
        ]);

        $Response = curl_exec($curl);

        return $Response;

        curl_close($curl);
    }
}
