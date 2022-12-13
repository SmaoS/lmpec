<h1 class="page-header">
    <?php echo $alm->secuencia != null ? $alm->secuencia : 'Nuevo Registro'; ?>
</h1>
<ol class="breadcrumb">
  <li><a href="?c=Venta&a=Crud&mesa=<?php echo $_REQUEST['mesa']; ?>">Volver a <?php echo $_REQUEST['mesa']; ?></a> </li>  
</ol>

<div class="formulario-editar">
<form action="?c=Venta&a=Guardar&mesa=<?php echo $_REQUEST['mesa']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="secuencia" value="<?php echo $alm->secuencia; ?>" />
    <input type="hidden" name="mesa" value="<?php echo $_REQUEST['mesa']; ?>" />
    
    <!-- <div class="form-group">
        <label>Codigo Producto</label>
        <input type="number" name="id_producto" value="<?php if($alm){ echo $alm->id_producto.'-'.$alm->nombre_pro;} ?>" class="form-control" placeholder="Ingrese Codigo Producto" data-validacion-tipo="requerido|min:3" />
    </div> -->
    <!-- <div class="form-group">
    <label>Nombre Producto</label>
   <select name="id_producto">
   <option value="<?php echo $alm->id_producto?>"></option>
   <label>Producto</label>
    <?php foreach($productos as $pro ): ?>
        <?php echo '<option name="id_producto" value="'.$pro->id_pro.'">'.$pro->nombre_pro.'</option>'; ?>
    <?php endforeach ;?>
    </select>
    </div> -->

    <label for="id_producto" class="form-label">Nombre Producto</label>

    <input class="form-control" list="datalistOptions" id="id_producto" name="id_producto" value="<?php echo $alm->secuencia != null ? $alm->id_producto.'-'.$alm->nombre_pro : ''; ?>" placeholder="Escribe para buscar...">
    <datalist id="datalistOptions">
    <?php foreach($productos as $pro ): ?>
        <?php echo '<option value="'.$pro->id_pro.'-'.$pro->nombre_pro.'">'; ?>
    <?php endforeach ;?>  
    </datalist>
  
    <div class="form-group">
        <label>Cantidad</label>
        <input type="number" name="cantidad" value="<?php echo $alm->cantidad? $alm->cantidad: 1; ?>" class="form-control" placeholder="Ingrese Cantidad" data-validacion-tipo="requerido|min:7" />
    </div>
    
    <div class="form-group">
        <label>Valor Unidad</label>
        <input type="number" name="valor" value="<?php echo $alm->valor; ?>" class="form-control" placeholder="Ingrese Valor" data-validacion-tipo="requerido|min:10" />
    </div>
    
    <div class="form-group">
        <label>Valor Total</label>
        <input type="number" name="valor_total" value="<?php echo $alm->valor_total; ?>" class="form-control" placeholder="Ingrese su Descripcion" data-validacion-tipo="requerido|min:8" disabled/>
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
