<?php
/**
 Template Name: Reparaciones
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
	$matricula = $_POST['matricula'];
	$fecha = $_POST['fecha'];
	$trabajos = $_POST['trabajos'];
	

	$sql= "INSERT INTO reparacion (matricula,fecha,trabajos) VALUES  ('".$matricula."','". $fecha."','". $trabajos."');";

	$result=$GLOBALS['wpdb']->query($sql);
	if ($result) {
		$_SESSION['mensaje']='Nueva reparacion archivada correctamente';
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
						
							<form action="<?php echo get_home_url();?>/reparaciones" method="post" enctype="multipart/form-data" >
							<div class=" row"> 
							<label for="matricula" class="col">Matricula</label>
							<input class="col form-control"type="text" name="matricula" class="ml-auto" value="">
							</div>								
							<br>
							<div class="row"> 
								<label for="fecha" class="col">fecha</label>
								<input type="date" name="fecha" value="" class="form-control">					
							</div>
								<br>
							<div class="row">
								
								<label for="trabajos" class="col">trabajos</label>
								<textarea  name="trabajos" value="" col="50" row="50" class="col form-control">
								</textarea>
							</div>
							<br>
							<div class="row">
								<input type="submit" name="submit" value="Enviar" class="col" >
							</div>
							
							</form>
							<?php if (isset($_SESSION['mensaje'] )):?>
							<div class="alert alert-<?php echo $_SESSION['tipoMensaje'] ?> alert-dismissible fade show" role="alert">
								<?php echo $_SESSION['mensaje'] ?>
								
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
								<th scope="col">Matricula</th>
								<th scope="col">Fecha</th>
								<th scope="col">Reaparaciones efectuadas</th>
								
								</tr>
							</thead>
							<tbody>
							<?php
								$sql="SELECT * FROM reparacion ORDER BY matricula";
								$reparaciones=$GLOBALS['wpdb']->get_results($sql);
								for ($i=0; $i < count($reparaciones); $i++) { 
							?>

							<tr>
								<th scope="row"><?php echo $reparaciones[$i]->id?>
								</th>
								<td><?php echo $reparaciones[$i]->matricula?></td>
								<td><?php echo $reparaciones[$i]->fecha?></td>
								<td><?php echo $reparaciones[$i]->trabajos?></td>								
								<td>
								<a href="<?php echo get_home_url();?>/editar-vehiculo?id=<?php echo $vehiculos[$i]->id?>">editar</a>
								<a href="<?php echo get_home_url();?>/borrar-vehiculo?id=<?php echo $vehiculos[$i]->id?>">borrar</a>
								</td>
							</tr>
							<?php								
								}					
							
								if (!$reparaciones) {									
									$_SESSION['mensaje']='Error al leer la base de datos '.$result;
									$_SESSION['tipoMensaje']="danger";
																	
								
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
