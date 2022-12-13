<h1 class="page-header">
    <?php echo $alm->id_cliente != null ? $alm->insta_cliente : 'Nuevo Cliente'; ?>
</h1>

<nav aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="?c=Cliente">Clientes</a></li>
  <li class="breadcrumb-item active"><?php echo $alm->id_cliente != null ? $alm->id_cliente : 'Nuevo Cliente'; ?></li>
</ol>
</nav>

<div class="formulario-editar">
<form action="?c=Cliente&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_cliente" value="<?php echo $alm->id_cliente; ?>" />
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="Nombres" value="<?php echo $alm->insta_cliente; ?>" class="form-control" placeholder="Ingrese su nombre y Apellido" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Cedula</label>
        <input type="text" name="Cedula" value="<?php echo $alm->cc_cliente; ?>" class="form-control" placeholder="Ingrese su Cedula" data-validacion-tipo="requerido|min:7" />
    </div>
    
    <div class="form-group">
        <label>Telefono</label>
        <input type="number" name="TelCliente" value="<?php echo $alm->tel_cliente; ?>" class="form-control" placeholder="Ingrese su telefono" data-validacion-tipo="requerido|min:10" />
    </div>
    
    <div class="form-group">
        <label>Dirección</label>
        <input type="text" name="dire_resid_cliente" value="<?php echo $alm->dire_resid_cliente; ?>" class="form-control" placeholder="Ingrese su dirección" data-validacion-tipo="requerido|min:8" />
    </div>
    
    <div class="form-group">
        <label>Correo</label>
        <input type="text" name="correo" value="<?php echo $alm->email_cliente; ?>" class="form-control" placeholder="Ingrese su correo electrónico" data-validacion-tipo="requerido|email_cliente" />
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
