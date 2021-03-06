<?php
require "../app/Tarefa.model.php";
require "../app/Tarefa.service.php";
require "../app/Database.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

function inserirTarefa()
{
    $tarefa = new Tarefa();
    $tarefa->__set('nome', $_POST['nome'])
           ->__set('descricao', $_POST['descricao'])
           ->__set('data_ini', $_POST['data_ini'])
           ->__set('data_fim', $_POST['data_fim']);

    $conn = new Database();

    $tarefaService = new TarefaService($conn, $tarefa);
    $tarefaService->create();
    echo 'teste';
    header('Location: nova_tarefa.php?inclusao=1');
}

function buscarTarefas()
{
    $tarefa = new Tarefa();
    $conn = new Database();

    $tarefaService = new TarefaService($conn, $tarefa);
    return $tarefaService->readAll();
}

function buscarTarefasPendentes()
{
    $tarefa = new Tarefa();
    $conn = new Database();

    $tarefaService = new TarefaService($conn, $tarefa);
    return $tarefaService->readPending();
}


function atualizarTarefa()
{
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id'])
           ->__set('nome', $_POST['nome'])
           ->__set('descricao', $_POST['descricao'])
           ->__set('data_ini', $_POST['data_ini'])
           ->__set('data_fim', $_POST['data_fim']);

    $conn = new Database();

    $tarefaService = new TarefaService($conn, $tarefa);

    $read = $tarefaService->update();

    if ($read = true) {
        header('Location: todas_tarefas.php');
    }
}

function removerTarefa()
{
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);

    $conn = new Database();

    $tarefaService = new TarefaService($conn, $tarefa);
    $red = $tarefaService->delete();

    if ($red = true) {
        header('Location: todas_tarefas.php');
    }
}
function concluirTarefa()
{
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
           
    $conn = new Database();

    $tarefaService = new TarefaService($conn, $tarefa);
    $tarefaService->updateStatus(2);
    return buscarTarefas();   
}

switch ($acao) {
    case 'inserir':
        inserirTarefa();
        break;
    case 'recuperar':
        $tarefas = buscarTarefas();
        break;
    case 'atualizar':
        atualizarTarefa();
        break;
    case 'remover':
        removerTarefa();
        break;
    case 'feito':
        $tarefas = concluirTarefa();
        break;
    case 'tarefasPendentes':
        $tarefas= buscarTarefasPendentes();
        break;    
}
