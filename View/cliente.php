<div class="container">
            <div class="row">
                <div class="col align-self-start">
                <h1 class="page-header">CLIENTES </h1>
                </div>
                <div class="col align-self-end">                    
                    <a class="btn btn-primary btn-lg me-md-2" href="?c=Cliente&a=Crud">Agregar Cliente</a>
                </div>
            </div>
        </div>

<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>
            <th >Nombres</th>
            <th>Cedula</th>
            <th>Telefono</th>
            <th >Direccion</th>
            <th >Correo</th>
            <th ></th>
            <th ></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->insta_cliente; ?></td>
            <td><?php echo $r->cc_cliente; ?></td>
            <td><?php echo $r->tel_cliente; ?></td>
            <td><?php echo $r->dire_resid_cliente; ?></td>
            <td><?php echo $r->email_cliente; ?></td>
            <td>
                <i class="glyphicon glyphicon-edit"><a href="?c=Cliente&a=Crud&id_cliente=<?php echo $r->id_cliente; ?>"> Editar</a></i>
            </td>
            <td>
                <i class="glyphicon glyphicon-remove"><a href="?c=Cliente&a=Eliminar&id_cliente=<?php echo $r->id_cliente; ?>"> Eliminar</a></i>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
</div>
