
<li><a href="?c=Venta">Volver </a></li> 
<?php $obtenermesasdet = $this->model->ListarDet($_REQUEST['mesa']) ?>
<?php  $total=0; foreach($obtenermesasdet as $r): ?>
<?php                 $total += $r->valor_total ;  ?> 
<?php endforeach; ?>

<?php $infmesa = $this->model->gettingNombreMesa($_REQUEST['mesa']) ?>
<div class="container">
    <div class="container">
        <div class="row justify-content-between">
                <div class="col-12">
                <h1 class="page-header">SERVICIO - <?php  echo $infmesa->nombre ?> Saldo : <?php echo  number_format($total) ?> </h1>
                </div>    
                <div class="col-4">                
                </div>                
                <div class="col-3">                    
                <a class="btn btn-primary btn-lg me-md-2" href="?c=Venta&a=CrudDet&mesa=<?php echo $_REQUEST['mesa']; ?>">Agregar Producto</a>    
                </div>
                
                    <?php if($obtenermesasdet): ?>
                        <div class="col-3">                    
                        <a class="btn btn-primary btn-lg me-md-2" href="?c=Venta&a=CerrarDetFact&mesa=<?php echo $_REQUEST['mesa']; ?>">Cerrar Venta Fact</a>                     
                        </div>
                        <div class="col-2">                    
                        <a class="btn btn-primary btn-lg me-md-2" href="?c=Venta&a=CerrarDet&mesa=<?php echo $_REQUEST['mesa']; ?>">Cerrar Venta</a>                     
                        </div>
                    <?php endif;?>
                
        </div>
    </div>

<input type="hidden" name="mesa" value="<?php echo $alm2->mesa; ?>" />
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-body float-right">
                    <form action="?c=Venta&a=Traslado" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row align-items-start">
                                    <input type="hidden" name="mesa" id="mesa" value="<?php echo $_REQUEST['mesa']; ?>" />
                                        
                                        <?php if($obtenermesasdet): ?>
                                            <div class="col">
                                                <select name="mesa_traslado" id="mesa_traslado" class="btn-lg me-md-6"  >
                                                    <option value="0"></option>
                                                    <label>Producto</label>
                                                    <?php foreach($mesas as $pro ): ?>
                                                        <?php echo '<option name="mesa_traslado" value="'.$pro->secuencia.'">'.$pro->nombre.'</option>'; ?>
                                                    <?php endforeach ;?>
                                                </select>
                                            </div>
                                            <div class="col">                                      
                                                <button class="btn btn-success btn-lg me-md-6" >Trasladar Mesa</button>
                                            </div> 
                                            <div class="col">                                      
                                                
                                            </div> 
                                            <div class="col">                                      
                                                
                                            </div> 
                                        <?php endif;?>
                                        
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php  foreach($obtenermesasdet as $r): ?>        
        <tr>                                
            <td><?php echo $r->nombre_pro; ?></td>
            <td><?php echo $r->cantidad; ?></td>
            <td><?php echo $r->valor; ?></td>
            <td><?php echo number_format($r->valor_total); ?></td>
            <td><?php echo $r->referencia; ?></td>            
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Venta&a=CrudDet&mesa=<?php echo $r->mesa; ?>&secuencia=<?php echo $r->secuencia; ?>"> Editar</a></i>
            </td>
            <td>
                <i class="glyphicon glyphicon-remove"><a href="?c=Venta&a=Eliminar&mesa=<?php echo $r->mesa; ?>&secuencia=<?php echo $r->secuencia; ?>"> Eliminar</a></i>
            </td>
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
            <th></th>            
            <th></th>            
        </tr>
    </thead>
</table> 
</div>

</div>
