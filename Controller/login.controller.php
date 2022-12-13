<?php
require_once 'Model/login-modelo.php';

class LoginController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Login();
    }
    
    public function Index(){
        require_once 'View/header.php';
        require_once 'View/login-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Crud(){
        $alm = new Login();
        
        if(isset($_REQUEST['id_login'])){
            $alm = $this->model->getting($_REQUEST['id_login']);
        }
        
        require_once 'View/header.php';
        require_once 'View/login-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Consultar(){
        $alm = new Login();        
        
        $alm->usuario = $_REQUEST['Usuarios'];
        $alm->contrasena = $_REQUEST['Contrasena'];


        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO
        
        $resultado = $this->model->Consultar($alm);
        if(!$resultado){            
            header('Location: index.php');
        }else{
            require_once 'View/header.php';
            require_once 'View/login.php';
            require_once 'View/footer.php';
        }

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        /*if ($alm->id_login > 0 ) {
            $this->model->Actualizar($alm);
        }
        else{
           $this->model->Registrar($alm); 
        }*/
        

    }
    
    public function Menu(){
            $resultado['ind_fuerza'] = 1;
            require_once 'View/header.php';
            require_once 'View/login.php';
            require_once 'View/footer.php';
    }
}
