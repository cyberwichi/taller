<?php
/**
 Template Name: Vehiculos
 */
get_header(); 
function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
if ($_POST){
	$fabricante = $_POST['fabricante'];
	$modelo = $_POST['modelo'];
	$submodelo = $_POST['submodelo'];
	$url_neumaticos = $_POST['url_neumaticos'];

	$sql= "INSERT INTO vehiculo (fabricante, modelo, submodelo, url_neumaticos) VALUES  ('".$fabricante."','". $modelo."','". $submodelo."','". $url_neumaticos."');";

	$result=$GLOBALS['wpdb']->query($sql);
	if ($result) {
		$_SESSION['mensaje']='Nuevo vehiculo archivado correctamente';
		$_SESSION['tipoMensaje']="success";
	}else{
		$_SESSION['mensaje']='Error al almacenar en la base de datos '.$result;
		$_SESSION['tipoMensaje']="danger";
	}
}


?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div id="center">

				<h2 class="entry-title text-center"><?php the_title();?></h2>

				<div class="container">			

					<div class="row">
						<div class="col-md-4 table-responsive">
						
							<form action="<?php echo get_home_url();?>/formulario" method="post" enctype="multipart/form-data" >
							<div class=" row"> 
							<label for="fabricante" class="col">Fabricante</label>
							<input class="col"type="text" name="fabricante" class="ml-auto" value="">
							</div>								
							<br>
							<div class="row"> 
								<label for="modelo" class="col">Modelo</label>
								<input type="text" name="modelo" value="">					
							</div>
								<br>
							<div class="row">
								
								<label for="submodelo" class="col">Submodelo</label>
								<input type="text" name="submodelo" value="" class="col">
							</div>
							<br>
							<div class="row">
								
								<label for="url_neumaticos" class="col">Url Neumaticos</label>
								<input type="text" name="url_neumaticos" value="" class="col">
															
							</div>
							<br>
							<div class="row">
								<input type="submit" name="submit" value="Enviar" class="col" >
							</div>
							
							</form>
							<?php if (isset($_SESSION['mensaje'] )):?>
							<div class="alert alert-<?php echo $_SESSION['tipoMensaje'] ?> alert-dismissible fade show" role="alert">
								<?php echo $_SESSION['mensaje'] ?>
								<strong><?=$_POST['fabricante'] ?></strong> 
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php session_unset();?>						
							<?php endif ?>
							
						</div>


						<div class="col-md-8">
						<div class="table-responsive">

							<table class="table table-hover table-dark">
							<thead>
								<tr>
								<th scope="col">#</th>
								<th scope="col">Fabricante</th>
								<th scope="col">Modelo</th>
								<th scope="col">Submodelo</th>
								<th scope="col">Url Neumaticos</th>
								<th scope="col">Acciones</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$sql="SELECT * FROM vehiculo ORDER BY id";
								$vehiculos=$GLOBALS['wpdb']->get_results($sql);
								for ($i=0; $i < count($vehiculos); $i++) { 
							?>

							<tr>
								<th scope="row"><?php echo $vehiculos[$i]->id?>
								</th>
								<td><?php echo $vehiculos[$i]->fabricante?></td>
								<td><?php echo $vehiculos[$i]->modelo?></td>
								<td><?php echo $vehiculos[$i]->submodelo?></td>
								<td><?php echo $vehiculos[$i]->url_neumaticos?></td>
								<td>
								<a href="<?php echo get_home_url();?>/editar-vehiculo?id=<?php echo $vehiculos[$i]->id?>">editar</a>
								<a href="<?php echo get_home_url();?>/borrar-vehiculo?id=<?php echo $vehiculos[$i]->id?>">borrar</a>
								</td>
							</tr>
							<?php								
								}					
							
								if (!$vehiculos) {									
									$_SESSION['mensaje']='Error al leer la base de datos '.$result;
									$_SESSION['tipoMensaje']="danger";
									redirect("/wp/formulario");									
								
								}else{
									
								}
								

								
							?>
								
								
							</tbody>
							</table>
							</div>
						
						
						
						</div>
					
					
					</div>
					
				
				</div>
				
				
			

			</div>
			


		</div><!-- #content -->
	</div><!-- #primary -->
	

<?php get_sidebar(); ?>
<?php get_footer(); ?>
