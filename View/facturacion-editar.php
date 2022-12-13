<li><a href="?c=Facturacion">Volver</a></li> <h1 class="page-header">Facturacion - N° <?php echo $_REQUEST['secuencia']?></h1>
<?php $obtenermesasdet = $this->model->ListarDet($_REQUEST['secuencia']) ?>
<div class="well well-sm text-right">
    
</div>

<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>                       
            <th>Producto</th>
            <th>Cantidad</th>            
            <th>Valor</th>
            <th>Valor Total</th>            
            <th>Referencia</th>   
        </tr>
    </thead>
    <tbody>
    <?php  $total=0; foreach($obtenermesasdet as $r): ?>
        <?php                 $total += $r->valor_total ;  ?>
        <tr>                                
            <td><?php echo $r->nombre_pro; ?></td>
            <td><?php echo $r->cantidad; ?></td>
            <td><?php echo number_format($r->valor); ?></td>
            <td><?php echo number_format($r->valor_total); ?></td>
            <td><?php echo $r->referencia; ?></td>       
        </tr>
    <?php endforeach; ?>
    </tbody>
    <thead>
        <tr>
            <th></th>            
            <th></th>
            <th>TOTAL</th>        
            <th><?php echo number_format($total) ?> </th>  
            <th></th>  
        </tr>
    </thead>
</table> 
</div>