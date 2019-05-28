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
	
 	if ($fecha < 1){
		$fecha= date("Y-m-d");
	}

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
						<div class="col-md-4 text-center">
						
							<form action="<?php echo get_home_url();?>/reparaciones" method="post" enctype="multipart/form-data" >
							
							<label for="matricula" class="row form-text">Matricula</label>
							<input class="row form-control"type="text" name="matricula" value="" required>
							<small id="" class="form-text text-muted">
							Introduzca la matricula del vehiculo 
							</small>
														
							<br>
							<label for="fecha" class="row form-text">Fecha</label>
							<input type="date" name="fecha" value="" class="form-control row text-center">
							<small id="" class="form-text text-muted">
							Introduzca la fecha de reparación del vehiculo si no introduce ninguna fecha se considerará la fecha actual 
							</small>					
							<br>
							<label for="trabajos" class="row  form-text">Trabajos</label>
							<textarea  name="trabajos" value="" rows="10" class="row form-control form-control-lg" required>
							</textarea>
							<small id="" class="form-text text-muted">
							Introduzca la reparaciones efectuadas en el vehiculo 
							</small>
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
								<a href="<?php echo get_home_url();?>/editar-reparacion?id=<?php echo $reparaciones[$i]->id?>"><i class="far fa-edit text-info mr-3"></i></a>
								<a href="<?php echo get_home_url();?>/borrar-reparacion?id=<?php echo $reparaciones[$i]->id?>"><i class="fas fa-ban text-danger"></i></a>
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
