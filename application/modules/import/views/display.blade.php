<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dipslay</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $i = 0;
                foreach($result as $row) { 
                ?>    
                    <tr>
                        <td><?php ++$i; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->country_code.$row->mobile; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->city; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>