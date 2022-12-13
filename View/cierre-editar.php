<h1 class="page-header">
    Nuevo Cierre
</h1>

<nav aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="?c=Cierre">Cierres</a></li>
  <li class="breadcrumb-item active">Nuevo Cierre</li>
</ol>
</nav>

<div class="formulario-editar">
<form action="?c=Cierre&a=Guardar" method="post" enctype="multipart/form-data">
        
    <div class="form-group">
        <label>Fecha Cierre</label>
        <input type="text" name="fecha_cierre" value="<?php echo $alm->fecha_sistema; ?>" class="form-control" readonly/>
    </div>
    
    <div class="form-group">
        <label>Fecha Inicial</label>
        <input type="text" name="fecha_inicial" value="<?php echo $alm->fecha_inicial; ?>" class="form-control" data-validacion-tipo="requerido|min:7" readonly/>
    </div>
       
    <div class="form-group">
        <label>Saldo Sistema</label>
        <input type="number" name="saldo_sistema" value="<?php echo $alm->saldo_sistema; ?>" class="form-control" readonly />
    </div>
    
    <div class="form-group">
        <label>Saldo Caja</label>
        <input type="number" name="saldo_caja" value="0" class="form-control" placeholder="Ingrese saldo de la caja" data-validacion-tipo="requerido|saldo_caja" />
    </div>

    <div class="form-group">
        <label>Observaciones</label>
        <input type="text"  name="observaciones" value="" class="form-control" placeholder="Ingrese las observaciones del cierre por favor" data-validacion-tipo="requerido|saldo_caja"/>        
    </div>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Generar Cierre</button>
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
