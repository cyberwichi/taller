<?php
/**
 Template Name: BorrarReparacion
 */
get_header(); 

global $wpdb;
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
$sql="SELECT * FROM reparacion WHERE id= $_GET[id]";
$reparacion=$wpdb->get_results($sql);


?>
<div class="container">
    <form action="<?php echo get_home_url();?>/borrar-reparacion" method="post" enctype="multipart/form-data" >
        <div class="justify-content-between"> 
        <label for="id">Id</label>
        <input class="align-self-end"type="text" name="id" class="ml-auto" value="<?php echo $reparacion[0]->id;?>" readonly>
        </div>
        <div class="justify-content-between"> 
        <label for="matricula">Matricula</label>
        <input class="align-self-end"type="text" name="matricula" class="ml-auto" value="<?php echo $reparacion[0]->matricula;?>">
        </div>								
        <br>
        <div class="justify-content-between"> 
        <label for="modelo">Fecha</label>
        <input type="datetime" name="fecha" value="<?php echo $reparacion[0]->fecha;?>">					
        </div>
        <br>
        <label for="trabajos">Reparaciones efectuadas</label>
        <textarea  name="trabajos" value="papapapapa" rows="10" class="row form-control form-control-lg"><?php echo $reparacion[0]->trabajos ?>
		</textarea>
        <br>
      
        <div class="form-check">
            <input class="form-check-input" type="radio" name="confirmacion" id="exampleRadios1" value="1" required>
            <label class="form-check-label" for="exampleRadios1">
            CONFIRMACION DE BORRADO
            </label>
        </div>
        <input type="submit" name="submit" value="Eliminar">

    </form>
</div>
<?php
if ($_POST){
    $id=$_POST['id'];
    $matricula = $_POST['matricula'];
	$fecha = $_POST['fecha'];
	$trabajos = $_POST['trabajos'];
    global $wpdb;
    IF ($_POST['confirmacion']=="1") {

    $result=$wpdb->delete( 'reparacion', array( 'ID' => $id ));
   
		if ($result) {
		$_SESSION['mensaje']='vehiculo actualizado correctamente';
        $_SESSION['tipoMensaje']="success";
        
	}else{
		$_SESSION['mensaje']='Error al almacenar en la base de datos '.$result;
		$_SESSION['tipoMensaje']="danger";
    }
    }
    redirect("reparaciones");
    
}
?>