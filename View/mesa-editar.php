<h1 class="page-header">
    <?php echo $alm->secuencia != null ? $alm->nombre : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Mesa">Mesas</a></li>
  <li class="active"><?php echo $alm->secuencia != null ? $alm->secuencia : 'Nuevo Registro'; ?></li>
</ol>

<form action="?c=Mesa&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="secuencia" value="<?php echo $alm->secuencia; ?>" />
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="Nombres" value="<?php echo $alm->nombre; ?>" class="form-control" placeholder="Ingrese su nombre mesa" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <select class="form-group" name="Estado">
        <label>Estado</label>
        <option value="0">Disponible</option>
        <option value="1">Ocupada</option>
    </select>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>
