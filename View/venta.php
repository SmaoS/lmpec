    <div class="container">

        <div class="container">
            <div class="row">
                <div class="col align-self-start">
                <h1 class="page-header">VENTAS </h1>
                </div>
                <div class="col align-self-end">                    
                    <a class="btn btn-primary btn-lg me-md-2" href="?c=Mesa&a=Crud">Agregar Mesa</a>
                </div>
            </div>
        </div>
   
<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>
            <th>Mesa</th>                
            <th>Estado</th>     
            <!-- <th>Descripcion Estado</th>        -->
            <th>Saldo Compra</th> 
            <th></th>            
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->nombre; ?></td>            
            <td><?php echo $r->estado == 0 ? 'LIBRE': 'OCUPADA' ; ?></td>
            <!-- <td><?php echo $r->nombre_estado; ?></td> -->     
            <td><?php echo number_format($r->valor_total); ?></td>               
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Venta&a=Crud&mesa=<?php echo $r->secuencia; ?>"> Ver Productos Mesa</a></i>
            </td>            
            <!-- <td>
                <i class="glyphicon glyphicon-remove"><a href="?c=Venta&a=Eliminar&mesa=<?php echo $r->secuencia; ?>"> Eliminar</a></i>
            </td> -->
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 

</div>