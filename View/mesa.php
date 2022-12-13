<div class="container">
    <div class="row">
        <div class="col align-self-start">
        <h1 class="page-header">MESAS </h1>
        </div>
        <div class="col align-self-end">                    
            <a class="btn btn-primary btn-lg me-md-2" href="?c=Mesa&a=Crud">Agregar Mesa</a>
        </div>
    </div>
</div>

<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Estado</th>            
            <th ></th>
            <th ></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->nombre; ?></td>
            <td><?php echo $r->estado; ?></td>           
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Mesa&a=Crud&secuencia=<?php echo $r->secuencia; ?>"> Editar</a></i>
            </td>
            <td>
                <i class="glyphicon glyphicon-remove"><a href="?c=Mesa&a=Eliminar&secuencia=<?php echo $r->secuencia; ?>"> Eliminar</a></i>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
</div>
