<?php
require_once 'Model/producto-modelo.php';

class ProductoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Producto();
    }
    
    public function Index(){
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/producto.php';
        require_once 'View/footer.php';
    }
    
    public function Crud(){
        $alm = new Producto();
        
        if(isset($_REQUEST['id_pro'])){
            $alm = $this->model->getting($_REQUEST['id_pro']);
        }
        
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/producto-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Guardar(){
        $alm = new Producto();
        
        $alm->id_pro = $_REQUEST['id_pro'];
        $alm->nombre_pro = $_REQUEST['Nombres'];
        $alm->tipo_pro = $_REQUEST['Tipo'];
        $alm->ref_pro = $_REQUEST['Referencia'];
        $alm->descrip_pro = $_REQUEST['descrip_pro'];
        $alm->precio_pro = $_REQUEST['precio'];
        $alm->cant_pro = $_REQUEST['cant'];
        $alm->id_pro > 0 
           ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);

        header('Location: index.php?c=Producto');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id_pro']);
        header('Location: index.php?c=Producto');
    }

   
}
