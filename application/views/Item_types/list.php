<div class="row">
    <div class="col-lg-12">           
        <h2>Item_types CRUD           
            <div class="pull-right">
               <a class="btn btn-primary" href="<?php echo base_url('Item_types/create') ?>"> Create New Item_type</a>
            </div>
        </h2>
     </div>
</div>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
      <tr>
          <th>item_type_name</th>
          <th>item_type_shortname</th>
      <th>Action</th>
      </tr>
  </thead>
  <tbody>
   <?php foreach ($data as $d) { ?>      
      <tr>
          <td><?php echo $d->item_type_name; ?></td>
          <td><?php echo $d->item_type_shortname; ?></td>          
      <td>
        <form method="DELETE" action="<?php echo base_url('Item_types/delete/'.$d->id);?>">
         <a class="btn btn-info btn-xs" href="<?php echo base_url('Item_types/edit/'.$d->id) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
          <button type="submit" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
        </form>
      </td>     
      </tr>
      <?php } ?>
  </tbody>
</table>
</div>