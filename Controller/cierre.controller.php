<?php
require_once 'Model/cierre-modelo.php';

class CierreController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Cierre();
    }
    
    public function Index(){
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/cierre.php';
        require_once 'View/footer.php';
    }
    
    public function Crud(){
        $alm = new Cierre();     
        $alm = $this->model->gettingCierre();
        
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/cierre-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Guardar(){
        $alm = new Cierre();
        
        $alm->fecha_cierre = $_REQUEST['fecha_cierre'];
        $alm->fecha_inicial = $_REQUEST['fecha_inicial'];        
        $alm->saldo_sistema = $_REQUEST['saldo_sistema'];
        $alm->saldo_caja = $_REQUEST['saldo_caja'];
        $alm->observaciones = $_REQUEST['observaciones'];        

        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO
        
        $this->model->Registrar($alm);

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        /*if ($alm->secuencia > 0 ) {
            $this->model->Actualizar($alm);
        }
        else{
           $this->model->Registrar($alm); 
        }*/
        header('Location: index.php?c=Cierre');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['secuencia']);
        header('Location: index.php?c=Cierre');
    }

   
}
