<?php
// Escode erros NOTICE
error_reporting(E_ERROR | E_PARSE);

/**
* Conecta ao banco e cria o schema (tabela Usuários)
*/
include_once('app/modelos/Banco.php');
Banco::createSchema();

/**
* Cria uma instância do controlador para uso
*/
include_once('app/controladores/Login.php');
$controller = new LoginController();

/**
* Seleciona a rota correta.
*/
switch ($_GET['acao']) {
    case 'cadastrar':
        $controller->cadastrar();
        break;
    case 'info':
        $controller->info();
        break;
    case 'listar':
        $controller->listar();
        break;
    case 'deletar':
        $controller->deletar();
        break;
    case 'sair':
        $controller->sair();
        break;
    default:
        $controller->login();
}

?>