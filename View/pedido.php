
<div class="container">
    <div class="row">
        <div class="col align-self-start">
        <h1 class="page-header">PEDIDOS </h1>
        </div>
        <div class="col align-self-end">                    
            <a class="btn btn-primary btn-lg me-md-2" href="?c=Pedido&a=Crud">Agregar Pedido</a>
        </div>
    </div>
</div>

<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>
            <th>Id Pedido</th>
            <th>Fecha</th>
            <th>Estado</th>            
            <th>Usuario</th>
            <th>Referencia</th>            
            <th>Valor</th>            
            <th></th>            
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->id_pedido; ?></td>            
            <td><?php echo $r->fecha; ?></td>
            <td><?php echo $r->estado; ?></td>
            <td><?php echo $r->usuario; ?></td>
            <td><?php echo $r->referencia; ?></td>
            <td><?php echo number_format($r->valor_total); ?></td>  
            <?php if($r->estado == 0) {?>          
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Pedido&a=Crud&id_pedido=<?php echo $r->id_pedido; ?>">Editar</a></i>
            </td>
            <?php }?>
            <?php if($r->estado != 0) {?>          
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Pedido&a=Crud&id_pedido=<?php echo $r->id_pedido; ?>">Ver</a></i>
            </td>
            <?php }?>
            <!-- <td>
                <i class="glyphicon glyphicon-remove"><a href="?c=Pedido&a=Eliminar&id_pedido=<?php echo $r->id_pedido; ?>"> Eliminar</a></i>
            </td> -->
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
</div>