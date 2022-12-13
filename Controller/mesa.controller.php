<?php
require_once 'Model/mesa-modelo.php';

class MesaController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Mesa();
    }
    
    public function Index(){
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/mesa.php';
        require_once 'View/footer.php';
    }
    
    public function Crud(){
        $alm = new Mesa();
        
        if(isset($_REQUEST['secuencia'])){
            $alm = $this->model->getting($_REQUEST['secuencia']);
        }
        
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/mesa-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Guardar(){
        $alm = new Mesa();
        
        $alm->secuencia = $_REQUEST['secuencia'];
        $alm->nombre = $_REQUEST['Nombres'];
        $alm->estado = $_REQUEST['Estado'];

        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO

        $alm->secuencia > 0 
           ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        /*if ($alm->secuencia > 0 ) {
            $this->model->Actualizar($alm);
        }
        else{
           $this->model->Registrar($alm); 
        }*/
        
        header('Location: index.php?c=Mesa');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['secuencia']);
        header('Location: index.php?c=Mesa');
    }
}
