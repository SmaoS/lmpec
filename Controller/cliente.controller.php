<?php
require_once 'Model/cliente-modelo.php';

class ClienteController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Cliente();
    }
    
    public function Index(){
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/cliente.php';
        require_once 'View/footer.php';
    }
    
    public function Crud(){
        $alm = new Cliente();
        
        if(isset($_REQUEST['id_cliente'])){
            $alm = $this->model->getting($_REQUEST['id_cliente']);
        }
        
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/cliente-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Guardar(){
        $alm = new Cliente();
        
        $alm->id_cliente = $_REQUEST['id_cliente'];
        $alm->insta_cliente = $_REQUEST['Nombres'];
        $alm->cc_cliente = $_REQUEST['Cedula'];
        $alm->tel_cliente = $_REQUEST['TelCliente'];
        $alm->dire_resid_cliente = $_REQUEST['dire_resid_cliente'];
        $alm->email_cliente = $_REQUEST['correo'];

        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO

        $alm->id_cliente > 0 
           ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        /*if ($alm->id_cliente > 0 ) {
            $this->model->Actualizar($alm);
        }
        else{
           $this->model->Registrar($alm); 
        }*/
        header('Location: index.php?c=Cliente');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_cliente']);
        header('Location: index.php?c=Cliente');
    }
}
