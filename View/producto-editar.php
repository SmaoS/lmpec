<h1 class="page-header">
    <?php echo $alm->id_pro != null ? $alm->nombre_pro : 'Nuevo Producto'; ?>
</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="?c=Producto">Productos </a></li>
        <li class="breadcrumb-item active"><?php echo $alm->id_pro != null ? $alm->id_pro : 'Nuevo Producto'; ?></li>
    </ol>
</nav>

<div class="formulario-editar">
<form action="?c=Producto&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_pro" value="<?php echo $alm->id_pro; ?>" />
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="Nombres" value="<?php echo $alm->nombre_pro; ?>" class="form-control" placeholder="Ingrese su nombre y Apellido" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Tipo Producto</label>
        <input type="text" name="Tipo" value="<?php echo $alm->tipo_pro; ?>" class="form-control" placeholder="Ingrese Tipo" data-validacion-tipo="requerido|min:7" />
    </div>
    
    <div class="form-group">
        <label>Referencia</label>
        <input type="text" name="Referencia" value="<?php echo $alm->ref_pro; ?>" class="form-control" placeholder="Ingrese Referencia" data-validacion-tipo="requerido|min:10" />
    </div>
    
    <div class="form-group">
        <label>Descripcion</label>
        <input type="text" name="descrip_pro" value="<?php echo $alm->descrip_pro; ?>" class="form-control" placeholder="Ingrese su Descripcion" data-validacion-tipo="requerido|min:8" />
    </div>
    
    <div class="form-group">
        <label>Precio</label>
        <input type="number" name="precio" value="<?php echo $alm->precio_pro; ?>" class="form-control" placeholder="Ingrese Precio" data-validacion-tipo="requerido|precio_pro" />
    </div>

    <div class="form-group">
        <label>Cantidad</label>
        <input type="number"  name="cant" value="<?php echo $alm->cant_pro; ?>" class="form-control" placeholder="Cantidad" data-validacion-tipo="requerido|precio_pro" readonly/>        
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
