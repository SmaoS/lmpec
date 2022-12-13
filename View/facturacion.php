<h1 class="page-header">Facturacion </h1>
<?php $obtenerfacturacion = $this->model->Listar();?>
<?php $suma = 0; foreach($obtenerfacturacion as $r): ?>
    <?php $suma += $r-> total_vent ;?>
<?php endforeach; ?>
<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombre Cliente</th>            
            <th>Estado</th>
            <th>Fecha</th>
            <th>Valor</th>
            <th>Mesa</th>
            <th ></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($obtenerfacturacion as $r): ?>
        <tr>            
            <td><?php echo $r->id_vent; ?></td>
            <td><?php echo $r->nombre_cliente; ?></td>
            <td><?php echo $r->estado; ?></td>
            <td><?php echo $r->fecha_vent; ?></td>  
            <td><?php echo number_format($r->total_vent); ?></td>
            <td><?php echo $r->nombre_mesa; ?></td>             
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Facturacion&a=Crud&secuencia=<?php echo $r->id_vent; ?>">Ver</a></i>
            </td>           
        </tr>
    <?php endforeach; ?>
    <thead>
        <tr>
            <th></th>
            <th></th>            
            <th></th>
            <th>VENTA DEL DIA</th>
            <th><?php echo number_format($suma);?></th>
            <th></th>
            <th ></th>
        </tr>
    </thead>

    </tbody>
</table> 
</div>