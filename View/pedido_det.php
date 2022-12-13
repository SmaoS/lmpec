<li><a href="?c=Pedido">Volver </a></li> 


<?php $obtenerpedidosdet = $this->model->ListarDet($_REQUEST['id_pedido']) ?>
<?php $obtenerpedido = $this->model->obtenerPedido($_REQUEST['id_pedido'])  ?>

<div class="container">
        <div class="row justify-content-between">
                <div class="col-6">
                <h1 class="page-header">PEDIDO - <?php echo $_REQUEST['id_pedido'] ? $_REQUEST['id_pedido'] : 'Nuevo Pedido'; ?></h1>
                </div>                
                <div class="col-3">                    
                    <a class="btn btn-primary" href="?c=Pedido&a=CrudDet&id_pedido=<?php echo $_REQUEST['id_pedido']; ?>">Agregar Producto</a>
                </div>
                <div class="col-3">                    
                    <?php if($obtenerpedido->estado == 0): ?>
                        <a class="btn btn-primary" href="?c=Pedido&a=CerrarDet&id_pedido=<?php echo $_REQUEST['id_pedido']; ?>">Cerrar Pedido</a>
                    <?php endif;?>
                </div>
        </div>
    </div>

<input type="hidden" name="id_pedido" value="<?php echo $alm2->id_pedido; ?>" />

<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>            
            <th>Id Producto</th>
            <th>Nombre Producto</th>
            <th>Cantidad</th>            
            <th>Valor</th>
            <th>Valor Total</th>            
            <th>Referencia</th>            
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php $total = 0; foreach($obtenerpedidosdet as $r): ?>
        <tr>          
        <?php  $total += $r->valor_total ;  ?>            
            <td><?php echo $r->id_producto; ?></td>
            <td><?php echo $r->nombre_pro; ?></td>
            <td><?php echo $r->cantidad; ?></td>
            <td><?php echo number_format($r->valor); ?></td>
            <td><?php echo number_format($r->valor_total); ?></td>
            <td><?php echo $r->referencia; ?></td> 
            <?php if($r->estado == 0) {?>  
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Pedido&a=CrudDet&id_pedido=<?php echo $r->id_pedido; ?>&secuencia=<?php echo $r->secuencia; ?>"> Editar</a></i>
            </td>
            <td>
                <i class="glyphicon glyphicon-remove"><a href="?c=Pedido&a=Eliminar&id_pedido=<?php echo $r->id_pedido; ?>&secuencia=<?php echo $r->secuencia; ?>"> Eliminar</a></i>
            </td>
            <?php }?>
        </tr>
    <?php endforeach; ?>
    <thead>
        <tr>            
            <th></th>
            <th></th>
            <th></th>            
            <th>TOTAL</th>
            <th><?php echo number_format($total) ?> </th>              
            <th></th>            
            <th></th>
            <th></th>   
        </tr>
    </thead>
    </tbody>
</table> 
</div>