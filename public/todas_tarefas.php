<?php

$acao = 'recuperar';
require './tarefa_controller.php';
/*
echo '<prev>';
print_r($tarefas);
echo '</prev>';
*/
?>
<script>
	function editar(id, txt) {

		let inputId = document.createElement('input')
		inputId.type ='hidden'
		inputId.name = 'id'
		inputId.value = id


		let form = document.createElement('form')
		form.action = 'tarefa_controller.php?acao=atualizar'
		form.method = 'post'
		form.className = 'row'

		let inputTarefa = document.createElement('input')
		inputTarefa.type = 'text'
		inputTarefa.name = 'tarefa'
		inputTarefa.className = 'col-9 form-control'
		inputTarefa.value = txt

		let button = document.createElement('button')
		button.type = 'submit'
		button.className = 'col-3 btn btn-info'
		button.innerHTML = 'Atualizar'

		form.appendChild(inputTarefa)
		form.appendChild(inputId)
		form.appendChild(button)


		let tarefa = document.getElementById('tarefa_' + id)
		tarefa.innerHTML = ''
		tarefa.insertBefore(form, tarefa[0])
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
					<li class="list-group-item"><a href="../index.php">Tarefas pendentes</a></li>
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

							<?php foreach ($tarefas as $indice => $tarefa) { ?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9 " id="tarefa_<?php echo ($tarefa->id) ?>">
										<?php echo ($tarefa->tarefa) ?> (<?php echo ($tarefa->status) ?>)
									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?php echo ($tarefa->id) ?>,'<?php echo ($tarefa->tarefa) ?>')"></i>
										<i class="fas fa-check-square fa-lg text-success"></i>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>