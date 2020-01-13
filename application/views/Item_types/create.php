<form method="post" action="<?php echo base_url('Item_typeCreate');?>">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">item_type_name</label>
                <div class="col-md-9">
                    <input type="text" name="item_type_name" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="col-md-3">item_type_shortname</label>
                <div class="col-md-9">
                    <textarea name="item_type_shortname" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2 pull-right">
            <input type="submit" name="Save" class="btn">
        </div>
    </div>
    
</form>
