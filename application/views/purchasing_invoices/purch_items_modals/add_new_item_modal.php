<style>
.btn-huge{
    height: 60px;
    padding-top:18px; 
}     
.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
} 
.btn-circle.btn-xl {
  width: 60px;
  height: 60px;
  padding: 15px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}

</style>
 <!-- Modal Checkout-->
   <?php echo form_open("", 'id="form_add_itm" class="form-horizontal"')?>  
   
<div class="modal fade" id="add_newitem_model"   role="dialog" aria-labelledby="exampleModalLabelItem" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelItem">New Item
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </h5>

      </div> 
      <div class="modal-body form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="ai_item_name" class="col-sm-3 control-label">Item Name<span style="color: red">*</span></label>
                <div class="col-sm-9">
                    <input type="ai_item_name" name="ai_item_name" class="form-control input-lg " id="ai_item_name" placeholder="Item Name">
                </div>
              </div>     
              <div class="form-group">
                <label for="city" class="col-sm-3 control-label">Item Category</label>
                <div class="col-sm-9"> 
                    <?php  echo form_dropdown('ai_cat_id',$item_category_list,set_value('ai_cat_id'),'style="width:100%" class="form-control input-lg select2" data-live-search="true" id="ai_cat_id"');?> 
                </div>
              </div>  
              <div class="form-group">
                <label for="city" class="col-sm-3 control-label">UOM</label>
                <div class="col-sm-9"> 
                    <?php  echo form_dropdown('ai_uom_id',$item_uom_list,set_value('ai_uom_id'),'style="width:100%" class="form-control input-lg select2" data-live-search="true" id="ai_uom_id"');?> 
                </div>
              </div>  
              <div class="form-group">
                <label for="ai_tags" class="col-sm-3 control-label">Items Tags(Coma Seprated)</label>
                <div class="col-sm-9">
                    <input type="ai_tags" name="ai_tags" class="form-control input-lg " id="ai_tags" placeholder="Eg: Phones, Foldable, Curved Display, Blue">
                </div>
              </div> 
                <div id="res_op_mod2"></div>
                
            </div> 
      </div>
      <div class="modal-footer"> 
          <div class="row">
              <div class="col-md-6"><a id="back_add_itm"  class="col-md-6 btn btn-block btn-primary btn-lg">Back </a></div>
              <div class="col-md-6"><a id="confirm_add_itm"  class="col-md-6 btn btn-block btn-primary btn-lg">Add Supplier</a></div>
          </div>
      </div> 
    </div>
  </div>
</div>  
<?php echo form_close();?>
<script>
    $(document).ready(function(){ 
        $('#item_add_new').click(function(){ 
           $('#add_newitem_model').modal({backdrop: 'static', keyboard: false }); 
        });
        $('#add_newitem_model').on('shown.bs.modal', function () {
            $('#ai_item_name').focus();
        })  
 
        
        $('#back_add_itm').click(function(){
            $('#add_newitem_model').modal('toggle'); 
        }); 
        $('#confirm_add_itm').click(function(){  
            
            if($('#ai_item_name').val()=='' || $('#ai_item_name').val().length<3){
                fl_alert('info',"Item Name Invalid!");
                $('#ai_item_name').focus().select();
                return false;
            } 
            add_itm_modal(); 
        });
        
    });
    
    function add_itm_modal(){
        var ret_val = 0;
        var post_data = jQuery('#form_add_itm').serializeArray(); 
            post_data.push({name:"function_name",value:'create_quick_item'}); 
                
            $.ajax({
                url: "<?php echo site_url('Purchasing_invoices/fl_ajax/');?>",
                type: 'post',
                data : post_data,
                success: function(result){ 
                    $('#res_op_mod2').html(result); 
                     if(result!='0'){
                        var $select = $('#item_desc');   
                        var option = $("<option/>").attr("value", result).text($('#ai_item_name').val());
                        $select.append(option); 
                        
                        $('#item_desc').select2();  
                        $('#item_code').val(result).trigger('keyup');
//                        $('#item_desc').val(result).change();
                        $('#add_newitem_model').modal('toggle'); 
                     }else{  
                        fl_alert('info',"Something went wrong!");
                     }
                }
            }); 
    }
</script>