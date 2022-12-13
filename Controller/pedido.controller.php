<?php
require_once 'Model/pedido-modelo.php';

class PedidoController {
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Pedido();
    }
    
    public function Index(){
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/pedido.php';
        require_once 'View/footer.php';
    }
    
    public function Crud(){
        $alm = new Pedido();
        $alm2 = new Pedido();
        if(isset($_REQUEST['id_pedido'])){
            $alm = $this->model->gettingDet($_REQUEST['id_pedido']);
            require_once 'View/header.php';
            require_once 'View/header2.php';
            require_once 'View/pedido_det.php';
            require_once 'View/footer.php';
            }            else{
            $alm2 = $this->model->RegistrarPedido();
            header('Location: index.php?c=Pedido&a=Crud&id_pedido='.$alm2->id_pedido);
        }
    }

    public function CrudDet(){
        $alm = new Pedido();
        
        if(isset($_REQUEST['secuencia'])){
            $alm = $this->model->gettingDet($_REQUEST['secuencia']);
            $alm->id_pedido = $_REQUEST['id_pedido'];
        }
        $productos = $this->model->gettingProductos();
        
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/pedido-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Guardar(){
        $alm = new Pedido();
        
        $alm->id_pedido = $_REQUEST['id_pedido'];
        $alm->secuencia = $_REQUEST['secuencia'];
        $alm->id_producto = $_REQUEST['id_producto'];
        $alm->referencia = $_REQUEST['referencia'];
        $alm->valor = $_REQUEST['valor'];
        $alm->valor_total = $_REQUEST['valor_total'];
        $alm->cantidad = $_REQUEST['cantidad'];

        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO

        $alm->secuencia > 0 
           ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        /*if ($alm->id_pedido > 0 ) {
            $this->model->Actualizar($alm);
        }
        else{
           $this->model->Registrar($alm); 
        }*/
        header('Location: index.php?c=Pedido&a=Crud&id_pedido='.$alm->id_pedido);
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['secuencia']);
        header('Location: index.php?c=Pedido&a=Crud&id_pedido='.$_REQUEST['id_pedido']);
    }

    public function CerrarDet(){
        $this->model->CerrarDet($_REQUEST['id_pedido']);
        header('Location: index.php?c=Pedido');
    }

    public function VistaProductos(){
        require '../Model/pedido-modelo.php';
        $alm = new Producto();       
        $objectoproductos = $this->model->Listar();
        require '../View/pedido-editar.php';

    }
}
