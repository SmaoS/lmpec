
<div class="container">
            <div class="row">
                <div class="col align-self-start">
                <h1 class="page-header">CIERRE DEL SISTEMA </h1>
                </div>
                <div class="col align-self-end">                    
                    <a class="btn btn-primary btn-lg me-md-2" href="?c=Cierre&a=Crud">Generar Cierre</a>
                </div>
            </div>
        </div>

<div class="container overflow-scroll" style="height: 450px">
<table class="table table-dark table-hover table-productos">
    <thead>
        <tr>
            <th>N° Cierre</th>            
            <th>Fecha Cierre</th>
            <th>Fecha Inicial</th>            
            <th>Fecha Final</th>
            <th>Saldo Sistema</th>
            <th>Saldo Caja</th>
            <th>Observaciones</th>    
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->secuencia; ?></td>                        
            <td><?php echo $r->fecha_cierre; ?></td>
            <td><?php echo $r->fecha_inicial; ?></td>
            <td><?php echo $r->fecha_final; ?></td>
            <td><?php echo number_format($r->saldo_sistema); ?></td>            
            <td><?php echo number_format($r->saldo_caja); ?></td>   
            <td><?php echo $r->observaciones; ?></td>         
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
</div>