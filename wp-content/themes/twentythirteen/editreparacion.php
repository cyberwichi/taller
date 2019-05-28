<?php
/**
 Template Name: EditarReparacion
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
    $id=$_POST['id'];
    $matricula = $_POST['matricula'];
	$fecha = $_POST['fecha'];
	$trabajos = $_POST['trabajos'];
    global $wpdb;
    $result=$wpdb->update( 'reparacion', 
      // Datos que se remplazarán
      array( 
        'matricula' => $matricula,
        'fecha' => $fecha,
        'trabajos' => $trabajos
      ),
  
      array( 'ID' => $id )
    );
   
		if ($result) {
		$_SESSION['mensaje']='Reparacion actualizada correctamente';
        $_SESSION['tipoMensaje']="success";
	}else{
		$_SESSION['mensaje']='Error al almacenar en la base de datos '.$result;
        $_SESSION['tipoMensaje']="danger";
       
    }
    redirect("reparaciones");

    
}

$sql="SELECT * FROM reparacion WHERE id = $_GET[id]";
$reparacion=$GLOBALS['wpdb']->get_results($sql);
$fecha=$reparacion[0]->fecha;
?>

<div class="container">
<form action="<?php echo get_home_url();?>/editar-reparacion" method="post" enctype="multipart/form-data" >							
        <div class="row"> 
        <label for="id" class="col-6">Id</label>
        <input class="align-self-end"type="text" name="id" class="ml-auto" value="<?php echo $reparacion[0]->id;?>" readonly>
        </div>
        <br>
        <div class="row">
            <label for="matricula" class="col-2 form-text">Matricula</label>
            <small id="" class="form-text text-muted col-4">
            Introduzca la matricula del vehiculo 
            </small>
            <input class="col-6 form-control" type="text" name="matricula" value="<?php echo $reparacion[0]->matricula ?>">
            
        </div>
		<br>

    <div class="row">
		<label for="fecha" class="col-2 form-text">Fecha</label>
        <small id="" class="form-text text-muted col-4">
		Introduzca la fecha de reparación del vehiculo si no introduce ninguna fecha se considerará la fecha actual 
		</small>
		<input type="datetime" name="fecha" value="<?php echo $fecha ?>" class="form-control col-6 text-center">
					
    </div>
		<br>
        <div class="row">
            <div class="col-2">
                <label for="trabajos" class="form-text mr-2">Trabajos</label>
                <small id="" class="form-text text-muted ">
                Introduzca la reparaciones efectuadas en el vehiculo 
                </small>
            </div>
            <textarea  name="trabajos" value="papapapapa" rows="10" class="col-10 form-control form-control-lg"><?php echo $reparacion[0]->trabajos ?>
            </textarea>
            
        
        </div>
		<br>
		<div class="row">
		<input type="submit" name="submit" value="Enviar" class="col" >
		</div>
		
		</form>
</div>

