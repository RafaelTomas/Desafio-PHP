<?php
require "../app/tarefa.model.php";
require "../app/Tarefa.service.php";
require "../app/Database.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {

  $tarefa = new Tarefa();
  $tarefa->__set('tarefa', $_POST['tarefa']);

  $conn = new Database();

  $tarefaService = new TarefaService($conn, $tarefa);
  $tarefaService->create();

  header('Location: nova_tarefa.php?inclusao=1');

} else if ($acao == 'recuperar') {

  $tarefa = new Tarefa();
  $conn = new Database();

  $tarefaService = new TarefaService($conn, $tarefa);
  $tarefas = $tarefaService->read();

} else if ($acao == 'atualizar') {

  $tarefa = new Tarefa();
  $tarefa->__set('id', $_POST['id'])
    ->__set('tarefa', $_POST['tarefa']);

  $conn = new Database();
 
  $tarefaService = new TarefaService($conn, $tarefa);
  $red = $tarefaService->update();

  if ($red = true) {
    header('Location: todas_tarefas.php');
  }

  } else if ($acao == 'remover') {

  $tarefa = new Tarefa();
  $tarefa->__set('id', $_GET['id']);

  $conn = new Database();

  $tarefaService = new TarefaService($conn, $tarefa);
  $red = $tarefaService->delete();

  if ($red = true) {
    header('Location: todas_tarefas.php');
  }
 
   
  }
