<?php
	require_once('vendor/autoload.php');
	use Github\Client;
?>
<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Otavio T F Cunha">
		<title>Acessa repositórios GitHub</title>
		<link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
		<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	</head>
	<script>
		$(document).ready(function () {
			$('#repositorios').DataTable();
		});
	</script>
<?php

	if(isset($_POST['nomeRepositorio'])){

		$client = new Client(); 
		$repositories = $client->api('user')->repositories($_POST['nomeRepositorio']); 
		
	}


?>	
	<body class="text-center">
<?php
	if(isset($_POST['nomeRepositorio'])){		
?>	
		<div class="container">
			<table id="repositorios">
				<thead>
					<tr>
						<th class="text-center">Nome do Repositório</th>
						<th class="text-center">Data criação</th>
						<th class="text-center">Data último commit</th>
						<th class="text-center">Link</th>
					</tr>
				</thead>
				<tbody>
<?php
		foreach($repositories as $repository){ 
			
?>
					<tr>
						<td><?php echo $repository['full_name'] ?></td>
						<td><span style="display: none;"><?php echo date("Y-m-d", strtotime($repository['created_at'])) ?></span><?php echo date("d/m/Y", strtotime($repository['created_at'])) ?></td>
						<td><span style="display: none;"><?php echo date("Y-m-d", strtotime($repository['updated_at'])) ?></span><?php echo date("d/m/Y", strtotime($repository['updated_at'])) ?></td>
						<td><a href="https://github.com/<?php echo $repository['full_name'] ?>" target="_blank"><button type="button" class="btn btn-success btn-sm">Acessar</button></a></td>
					</tr>
<?php
		}
?>	
				</tbody>
			</table>
			<a href="index.php"><button class="w-100 btn btn-lg btn-danger" type="submit">Voltar</button></a>			
		</div>
<?php	
	}else{
?>		
		<main class="form-signin w-500 m-auto">	
			<form method="post" action="">
				<img class="mb-4" src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="" width="72">
				<h1 class="h3 mb-3 fw-normal">Digite o nome do repositório que deseja analisar:</h1>

				<div class="form-floating">
				  <input type="text" class="form-control" name="nomeRepositorio" id="floatingInput" placeholder="otaviotfcunha" value="otaviotfcunha">
				  <label for="floatingInput">Nome do Repositório:</label>
				</div>	
				<br>
				<button class="w-100 btn btn-lg btn-primary" type="submit">Analisar</button>				
			</form>
		</main>
<?php
	}
?>				
	</body>
	
</html>



