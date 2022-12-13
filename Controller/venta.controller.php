<?php
require_once 'Model/venta-modelo.php';

class VentaController {
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Venta();
    }
    
    public function Index(){
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/venta.php';
        require_once 'View/footer.php';
    }
    
    public function Crud(){
        $alm = new Venta();
        $alm2 = new Venta();
        if(isset($_REQUEST['mesa'])){
            $alm = $this->model->gettingDet($_REQUEST['mesa']);
            $mesas = $this->model->gettingMesas();
            require_once 'View/header.php';
            require_once 'View/header2.php';
            require_once 'View/venta_det.php';
            require_once 'View/footer.php';
            } else{
            $mesas = $this->model->gettingMesas();
            $alm2 = $this->model->RegistrarVenta();
            header('Location: index.php?c=Venta&a=Crud&mesa='.$alm2->mesa);
        }
    }

    public function Traslado(){
        $alm = new Venta();
        $alm2 = new Venta();
        if(isset($_REQUEST['mesa_traslado']) && isset($_REQUEST['mesa']) && $_REQUEST['mesa_traslado'] > 0){
            $this->model->postTraslado($_REQUEST['mesa_traslado'],$_REQUEST['mesa']);
            // $alm = $this->model->gettingDet($_REQUEST['mesa_traslado']);
            $mesas = $this->model->gettingMesas();           
            header('Location: index.php?c=Venta&a=Crud&mesa='.$_REQUEST['mesa_traslado']);
            }else{
                header('Location: index.php?c=Venta&a=Crud&mesa='.$_REQUEST['mesa']);
            }
        
    }

    public function CrudDet(){
        $alm = new Venta();
        
        if(isset($_REQUEST['secuencia'])){
            $alm = $this->model->gettingDet($_REQUEST['secuencia']);
            $alm->mesa = $_REQUEST['mesa'];
        }
        $productos = $this->model->gettingProductos();
        
        require_once 'View/header.php';
        require_once 'View/header2.php';
        require_once 'View/venta-editar.php';
        require_once 'View/footer.php';
    }
    
    public function Guardar(){
        $alm = new Venta();

        $datosProducto = explode("-", $_REQUEST['id_producto']);

        $producto = $this->model->gettingPrecioProducto($datosProducto[0]);

        $alm->mesa = $_REQUEST['mesa'];
        $alm->secuencia = $_REQUEST['secuencia'];
        $alm->id_producto = $datosProducto[0];
        $alm->referencia = $_REQUEST['referencia'];
        $alm->cantidad = $_REQUEST['cantidad'];
        $alm->valor = $_REQUEST['valor'] ? $_REQUEST['valor']: $producto[0]->precio_pro;
        $alm->valor_total = $alm->valor*$alm->cantidad;
        

        // SI ID PERSONA ES MAYOR QUE CERO (0) INDICA QUE ES UNA ACTUALIZACIÓN DE ESA TUPLA EN LA TABLA PERSONA, SINO SIGNIFICA QUE ES UN NUEVO REGISTRO

        $alm->secuencia > 0 
           ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);

       //EL CÓDIGO ANTERIOR ES EQUIVALENTE A UTILIZAR CONDICIONALES IF, TAL COMO SE MUESTRA EN EL COMENTARIO A CONTINUACIÓN:

        /*if ($alm->mesa > 0 ) {
            $this->model->Actualizar($alm);
        }
        else{
           $this->model->Registrar($alm); 
        }*/
        
        header('Location: index.php?c=Venta&a=Crud&mesa='.$alm->mesa);
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['secuencia']);
        header('Location: index.php?c=Venta&a=Crud&mesa='.$_REQUEST['mesa']);
    }

    public function CerrarDet(){

        $this->model->CerrarDet($_REQUEST['mesa'], 0);        
        // $this->model->imprimirFactura();

        // require_once 'View/header.php';
        // require_once 'View/header2.php';
        // require_once 'View/venta.php';
        // require_once 'View/footer.php';
        header('Location: index.php?c=Venta');
    }

    public function CerrarDetFact(){

        $this->model->CerrarDet($_REQUEST['mesa'], 1);        
        // $this->model->imprimirFactura();

        // require_once 'View/header.php';
        // require_once 'View/header2.php';
        // require_once 'View/venta.php';
        // require_once 'View/footer.php';
        header('Location: index.php?c=Venta');
    }

    public function VistaProductos(){
        require '../Model/venta-modelo.php';
        $alm = new Producto();       
        $objectoproductos = $this->model->Listar();
        require '../View/venta-editar.php';

    }
}
