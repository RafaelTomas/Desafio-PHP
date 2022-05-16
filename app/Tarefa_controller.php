<?php
  require "../app/tarefa.model.php";
  require "../app/Tarefa.service.php";
  require "../app/Database.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao; 

    if($acao == 'inserir') {
    
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);
    
    $conn = new Database();

    $tarefaService = new TarefaService($conn, $tarefa);
    
    $tarefaService->create();
    header('Location: nova_tarefa.php?inclusao=1');
  
    }else if ( $acao == 'recuperar') {

      $tarefa = new Tarefa();
      $conn = new Database();

      $tarefaService = new TarefaService($conn, $tarefa);
      $tarefas = $tarefaService->read();

    }
?>