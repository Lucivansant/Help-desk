<?php
header('access-control-allow-origin: *');
header('Content-Type: application/json');

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';
require_once './App_config/Config_conect/Conect.php';
require_once './App_config/Controller/Controller.php';

$app = AppFactory::create();

$app->group('/v1', function (RouteCollectorProxy $group) {

    //Verifica o login do funcionário.
    $group->any('/Login_func', function (Request $request, Response $response) {
        $Post_func = $request->getParsedBody();


        $conexao = new Conect();
        $controller = new Controller($conexao);
        $result_func = $controller->Get_func($Post_func['email'], $Post_func['senha']);


        $result_json = json_encode($result_func);

        $response->getBody()->write($result_json);
        return $response;
    });

    //Verifica o login do adm.
    $group->any('/Login_adm', function (Request $request, Response $response) {
        $Post_adm = $request->getParsedBody();


        $conexao = new Conect();
        $controller = new Controller($conexao);
        $result_adm = $controller->Get_adm($Post_adm['email'], $Post_adm['senha']);
        $result_json = json_encode($result_adm);

        $response->getBody()->write($result_json);
        return $response;
    });

    //=====================================================================================//
    //Registra os chamados.
    $group->any('/Registra_chamado', function (Request $request, Response $response) {
        $Post_Chamados = $request->getParsedBody();


        $conexao = new Conect();
        $controller = new Controller($conexao);
        $controller->Add_chamados($Post_Chamados['titulo'], $Post_Chamados['opt_setor'], $Post_Chamados['opt_categoria'], $Post_Chamados['desc'], $Post_Chamados['status'], $Post_Chamados['funcionario']);


        $response->getBody()->write("");
        return $response;
    });
    //Pega todos os chamados.
    $group->any('/Seleciona_individual_chamado', function (Request $request, Response $response) {
        $Post_Chamados = $request->getParsedBody();

        $conexao = new Conect();
        $controller = new Controller($conexao);
        $result_chamados = $controller->Select_chamados($Post_Chamados['funcionario']);
        $result_json = json_encode($result_chamados);

        $response->getBody()->write($result_json);
        return $response;
    });
    $group->any('/Seleciona_todos_chamado', function (Request $request, Response $response) {
        //$Post_Chamados = $request->getParsedBody();

        $conexao = new Conect();
        $controller = new Controller($conexao);
        $result_chamados = $controller->Select_todos_chamados();
        $result_json = json_encode($result_chamados);

        $response->getBody()->write($result_json);
        return $response;
    });

    $group->any('/Atualiza_chamado', function (Request $request, Response $response) {
        $Post_atualiza = $request->getParsedBody();

        $conexao = new Conect();
        $controller = new Controller($conexao);
        $controller->Update_chamado($Post_atualiza['status'], $Post_atualiza['id']);

        $response->getBody()->write("");
        return $response;
    });
});
$app->run();
