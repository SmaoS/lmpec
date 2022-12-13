

<ol class="breadcrumb">
  <li><a href="?c=Login">Iniciar Sesion</a></li>  
</ol>
<div class="formulario-editar">
<form action="?c=Login&a=Consultar" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label>Usuario</label>
        <input type="text" name="Usuarios" value="" class="form-control" placeholder="Ingrese su usuario" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="Contrasena" value="" class="form-control" placeholder="Ingrese su Contraseña" data-validacion-tipo="requerido|min:7" />
    </div>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Ingresar</button>
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
