<div class="container">
    <div class="container">
        <div class="row">
            <div class="col align-self-start">
            <h1 class="page-header">Productos </h1>
            </div>
            <div class="col align-self-end">                    
                <a class="btn btn-primary btn-lg me-md-2" href="?c=Producto&a=Crud">Agregar Producto</a>
            </div>
        </div>
    </div>
<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead style="background-color: #f39c12">
        <tr>
            <th >Codigo</th>
            <th >Nombre</th>
            <th >Tipo</th>            
            <th >Precio</th>
            <th >Cantidad</th>
            <th >Referencia</th>
            <th >Descripcion</th>            
            <th ></th>
            <th ></th>
        </tr>
    </thead>    
    <tbody >
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td ><?php echo $r->id_pro; ?></td>                        
            <td ><?php echo $r->nombre_pro; ?></td>
            <td ><?php echo $r->tipo_pro; ?></td>
            <td ><?php echo number_format($r->precio_pro); ?></td>
            <td ><?php echo $r->cant_pro; ?></td>
            <td ><?php echo $r->ref_pro; ?></td>
            <td ><?php echo $r->descrip_pro; ?></td>            
            <td >
                <i class="glyphicon glyphicon-edit"><a href="?c=Producto&a=Crud&id_pro=<?php echo $r->id_pro; ?>"> Editar</a></i>
            </td>
            <td >
                <i class="glyphicon glyphicon-remove"><a href="?c=Producto&a=Eliminar&id_pro=<?php echo $r->id_pro; ?>"> Eliminar</a></i>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>    
</table> 
</div>
