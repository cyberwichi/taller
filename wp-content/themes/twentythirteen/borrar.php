<?php
/**
 Template Name: BorrarVehiculo
 */
get_header(); 
echo "hola";
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
$sql="SELECT * FROM vehiculo WHERE id= $_GET[id]";
$vehiculo=$wpdb->get_results($sql);


?>
<div class="container">
    <form action="<?php echo get_home_url();?>/borrar-vehiculo" method="post" enctype="multipart/form-data" >
        <div class="justify-content-between"> 
        <label for="id">Id</label>
        <input class="align-self-end"type="text" name="id" class="ml-auto" value="<?php echo $vehiculo[0]->id;?>" readonly>
        </div>
        <div class="justify-content-between"> 
        <label for="fabricante">Fabricante</label>
        <input class="align-self-end"type="text" name="fabricante" class="ml-auto" value="<?php echo $vehiculo[0]->fabricante;?>">
        </div>								
        <br>
        <div class="justify-content-between"> 
        <label for="modelo">Modelo</label>
        <input type="text" name="modelo" value="<?php echo $vehiculo[0]->modelo;?>">					
        </div>
        <br>
        <label for="submodelo">Submodelo</label>
        <input type="text" name="submodelo" value="<?php echo $vehiculo[0]->submodelo;?>">
        <br>
        <label for="url_neumaticos">Url Neumaticos</label>
        <input type="text" name="url_neumaticos" value="<?php echo $vehiculo[0]->url_neumaticos;?>">
        <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="confirmacion" id="exampleRadios1" value="1" >
            <label class="form-check-label" for="exampleRadios1">
            CONFIRMACION DE BORRADO
            </label>
        </div>
        <input type="submit" name="submit" value="Modificar">

    </form>
</div>
<?php
if ($_POST){
    $id=$_POST['id'];
	$fabricante = $_POST['fabricante'];
	$modelo = $_POST['modelo'];
	$submodelo = $_POST['submodelo'];
    $url_neumaticos = $_POST['url_neumaticos'];  
    IF ($_POST['confirmacion']=="1") {

    $result=$wpdb->delete( 'vehiculo', array( 'ID' => $id ));
   
		if ($result) {
		$_SESSION['mensaje']='vehiculo actualizado correctamente';
        $_SESSION['tipoMensaje']="success";
        
	}else{
		$_SESSION['mensaje']='Error al almacenar en la base de datos '.$result;
		$_SESSION['tipoMensaje']="danger";
    }
    }
    redirect("formulario");
    
}
?>