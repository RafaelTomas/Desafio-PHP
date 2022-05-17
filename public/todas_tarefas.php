<?php

$acao = 'recuperar';
require './tarefa_controller.php';

?>
<script>
	function editar(id, _nome, _descricao, _data_ini, _data_fim) {

		let inputId = document.createElement('input')
		inputId.type = 'hidden'
		inputId.name = 'id'
		inputId.value = id


		let form = document.createElement('form')
		form.action = 'tarefa_controller.php?acao=atualizar'
		form.method = 'post'
		form.className = 'row'

		let inputNome = document.createElement('input')
		inputNome.type = 'text'
		inputNome.name = 'nome'
		inputNome.className = 'col-9 form-control'
		inputNome.value = _nome

		let inputDescricao = document.createElement('textarea')
		inputDescricao.type = 'text'
		inputDescricao.name = 'descricao'
		inputDescricao.className = 'col-9 form-control'
		inputDescricao.value = _descricao

		let inputData_ini = document.createElement('input')
		inputData_ini.type = 'date'
		inputData_ini.name = 'data_ini'
		inputData_ini.className = 'col-9 form-control'
		inputData_ini.value = _data_ini

		let inputData_fim = document.createElement('input')
		inputData_fim.type = 'date'
		inputData_fim.name = 'data_fim'
		inputData_fim.className = 'col-9 form-control'
		inputData_fim.value = _data_fim

		let button = document.createElement('button')
		button.type = 'submit'
		button.className = 'col-3 btn btn-info'
		button.innerHTML = 'Atualizar'

		form.appendChild(inputNome)
		form.appendChild(inputDescricao)
		form.appendChild(inputData_ini)
		form.appendChild(inputData_fim)
		form.appendChild(inputId)
		form.appendChild(button)


		let nome = document.getElementById('nome_' + id)
		nome.innerHTML = ''
		nome.insertBefore(form, nome[0])

		let descricao = document.getElementById('descricao_' + id)
		descricao.innerHTML = ''
		descricao.insertBefore(form, descricao[0])

		let data_ini = document.getElementById('data_ini_' + id)
		data_ini.innerHTML = ''
		data_ini.insertBefore(form, data_ini[0])

		let data_fim = document.getElementById('data_fim_' + id)
		data_fim.innerHTML = ''
		data_fim.insertBefore(form, data_fim[0])
	}

	function remover(id) {
		location.href = `todas_tarefas.php?acao=remover&id=${id}`;
	}

	function feito(id) {
		location.href = `todas_tarefas.php?acao=feito&id=${id}`;
	}
</script>

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agenda eletrônica</title>

	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">
				Agenda eletrônica
			</a>
		</div>
	</nav>

	<div class="container app">
		<div class="row">
			<div class="col-sm-3 menu">
				<ul class="list-group">
					<li class="list-group-item"><a href="./index.php">Tarefas pendentes</a></li>
					<li class="list-group-item"><a href="./nova_tarefa.php">Nova tarefa</a></li>
					<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
				</ul>
			</div>

			<div class="col-sm-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Todas tarefas</h4>
							<hr />
							<?php if (empty($tarefas)) { ?>
								<p>Nenhuma tarefa encontrada</p>
							<?php } ?>
							<?php foreach ($tarefas as $indice => $tarefa) { ?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9 " id="nome_<?php echo ($tarefa->id) ?>">
										<h6>Nome:</h6>
										<p><?php echo ($tarefa->nome) ?> (<?php echo ($tarefa->status) ?>)</p>
									</div>
									<div class="col-sm-9 " id="descricao_<?php echo ($tarefa->id) ?>">
										<h6>Descrição:</h6>
										<p><?php echo ($tarefa->descricao) ?></p>
									</div>
									<div class="col-sm-9 " id="data_ini_<?php echo ($tarefa->id) ?>">
										<h6>Data inicial:</h6>
										<p><?php echo ($tarefa->data_ini) ?></p>
									</div>
									<div class="col-sm-9 " id="data_fim_<?php echo ($tarefa->id) ?>">
										<h6>Data final:</h6>
										<p><?php echo ($tarefa->data_fim) ?></p>
									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?php echo ($tarefa->id) ?>)"></i>
										<?php if ($tarefa->status == 'pendente') { ?>
											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?php echo ($tarefa->id) ?>,'<?php echo ($tarefa->nome) ?>','<?php echo ($tarefa->descricao) ?>','<?php echo ($tarefa->data_ini) ?>','<?php echo ($tarefa->data_fim) ?>')"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick="feito(<?php echo ($tarefa->id) ?>)"></i>
										<?php } ?>
									</div>
								</div>
								<hr>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>