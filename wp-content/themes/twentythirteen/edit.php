<?php
/**
 Template Name: EditarVehiculo
 */
get_header(); 
if ($_POST){
    $id=$_POST['id'];
	$fabricante = $_POST['fabricante'];
	$modelo = $_POST['modelo'];
	$submodelo = $_POST['submodelo'];
    $url_neumaticos = $_POST['url_neumaticos'];
    global $wpdb;
    $result=$wpdb->update( 'vehiculo', 
      // Datos que se remplazarán
      array( 
        'fabricante' => $fabricante,
        'modelo' => $modelo,
        'submodelo' => $submodelo,
        'url_neumaticos' => $url_neumaticos
      ),
  
      array( 'ID' => $id )
    );
   
		if ($result) {
		$_SESSION['mensaje']='vehiculo actualizado correctamente';
        $_SESSION['tipoMensaje']="success";
	}else{
		$_SESSION['mensaje']='Error al almacenar en la base de datos '.$result;
        $_SESSION['tipoMensaje']="danger";
       
    }
    redirect("formulario");

    
}

$sql="SELECT * FROM vehiculo WHERE id= $_GET[id]";
$vehiculo=$GLOBALS['wpdb']->get_results($sql);

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


?>
<div class="container col-5">
    <form action="<?php echo get_home_url();?>/editar-vehiculo" method="post" enctype="multipart/form-data" >
        <div class="row"> 
        <label for="id" class="col-6">Id</label>
        <input class="align-self-end col-6"type="text" name="id" class="ml-auto" value="<?php echo $vehiculo[0]->id;?>" readonly>
        </div>
        <br>
        <div class="row"> 
        <label for="fabricante" class="col-6" >Fabricante</label>
        <input class="align-self-end col-6" type="text" name="fabricante" class="ml-auto" value="<?php echo $vehiculo[0]->fabricante;?>">
        </div>								
        <br>
        <div class="row"> 
        <label for="modelo" class="col-6" >Modelo</label>
        <input type="text" class="col-6" name="modelo" value="<?php echo $vehiculo[0]->modelo;?>">					
        </div>
        <br>
        <div class="row">
        <label for="submodelo" class="col-6">Submodelo</label>
        <input type="text" class="col-6" name="submodelo" value="<?php echo $vehiculo[0]->submodelo;?>">
        </div>
        <br>
        <div class="row">
        <label for="url_neumaticos" class="col-6" >Url Neumaticos</label>
        <input type="text" class="col-6" name="url_neumaticos" value="<?php echo $vehiculo[0]->url_neumaticos;?>">
        </div>
        <br>
        <div class="row">
        <input  class="col-12" type="submit" name="submit" value="Modificar">
        </div>

    </form>
</div>

