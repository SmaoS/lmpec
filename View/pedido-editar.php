<h1 class="page-header">Pedido
    <?php echo $alm->secuencia != null ? $alm->secuencia : 'Agregando Producto'; ?>
</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="?c=Pedido">Volver</a></li>
    <li class="breadcrumb-item active"><?php echo $alm->secuencia != null ? $alm->secuencia : 'Agregando Producto'; ?></li>
    </ol>
</nav>
<div class="formulario-editar">
<form action="?c=Pedido&a=Guardar&id_pedido=<?php echo $_REQUEST['id_pedido']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="secuencia" value="<?php echo $alm->secuencia; ?>" />
    <input type="hidden" name="id_pedido" value="<?php echo $_REQUEST['id_pedido']; ?>" />
    
    <!-- <div class="form-group">
        <label>Codigo Producto</label>
        <input type="number" name="id_producto" value="<?php echo $alm->id_producto; ?>" class="form-control" placeholder="Ingrese Codigo Producto" data-validacion-tipo="requerido|min:3" />
    </div> -->
    <div class="form-group">
    <label>Nombre Producto</label>
   <select name="id_producto">
   <option value="<?php echo $alm->id_producto?>"></option>
   <label>Producto</label>
    <?php foreach($productos as $pro ): ?>
        <?php echo '<option name="id_producto" value="'.$pro->id_pro.'">'.$pro->nombre_pro.'</option>'; ?>
    <?php endforeach ;?>
    </select>
    </div>
    
    <div class="form-group">            
        <input type="text" name="nombres" value="<?php echo $alm->secuencia != null ? $alm->nombre_pro : ''; ?>" class="form-control" placeholder="Ingrese Codigo Producto" data-validacion-tipo="requerido|min:3" disabled/>
    </div>

    <div class="form-group">
        <label>Cantidad</label>
        <input type="number" name="cantidad" value="<?php echo $alm->cantidad; ?>" class="form-control" placeholder="Ingrese Cantidad" data-validacion-tipo="requerido|min:7" />
    </div>
    
    <div class="form-group">
        <label>Valor Unidad</label>
        <input type="number" name="valor" value="<?php echo $alm->valor; ?>" class="form-control" placeholder="Ingrese Valor" data-validacion-tipo="requerido|min:10" disabled/>
    </div>
    
    <div class="form-group">
        <label>Valor Total</label>
        <input type="number" name="valor_total" value="<?php echo $alm->valor_total; ?>" class="form-control" placeholder="Ingrese su Descripcion" data-validacion-tipo="requerido|min:8"/>
    </div>
    
    <div class="form-group">
        <label>Referencia</label>
        <input type="text" name="referencia" value="<?php echo $alm->referencia; ?>" class="form-control" placeholder="Ingrese Referencia" data-validacion-tipo="requerido|precio_pro" />
    </div>
  
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>
</div>
<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>
