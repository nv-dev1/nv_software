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
   <?php echo form_open("", 'id="form_add_cust" class="form-horizontal"')?>  
   
<div class="modal fade" id="add_qkitem_modal"   role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Item Quick Add
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </h5>

      </div> 
      <div class="modal-body form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="new_qkitem_category_id" class="col-sm-3 control-label">Category Type</label>
                <div class="col-sm-9"> 
                    <?php  echo form_dropdown('new_qkitem_category_id',$item_category_list,set_value('new_qkitem_category_id','1'),'style="width:100%" class="form-control input-lg select2" data-live-search="true" id="new_qkitem_category_id"');?> 
                </div>
              </div>
              <div class="form-group">
                <label for="new_qkitem_name" class="col-sm-3 control-label">Item Name<span style="color: red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="new_qkitem_name" class="form-control input-lg checkout_input" id="new_qkitem_name" placeholder="Item Name">
                </div>
              </div>
                <div class="form-group">
                <label for="new_qkitem_uom_id" class="col-sm-3 control-label">UOM</label>
                <div class="col-sm-9"> 
                    <?php  echo form_dropdown('new_qkitem_uom_id',$item_uom_list,set_value('new_qkitem_uom_id'),'style="width:100%" class="form-control input-lg"  id="new_qkitem_uom_id"');?> 
                </div>
              </div>   
              <div class="form-group">
                <label for="new_qkitem_tags" class="col-sm-3 control-label">Tags</label>
                <div class="col-sm-9">
                    <input type="text" name="new_customer_new_qkitem_tags" class="form-control input-lg checkout_input" id="new_qkitem_tags" placeholder="Enter any Tags coma seperated">
                </div>
              </div>  
              <div class="form-group">
                <label for="new_qkitem_sales_price" class="col-sm-3 control-label">Sales Price<span style="color: red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="new_qkitem_sales_price" class="form-control input-lg checkout_input" value="0"  id="new_qkitem_sales_price" placeholder="Seling Priuce">
                </div>
              </div>
              <div class="form-group">
                <label for="new_qkitem_sales_price_unit" class="col-sm-3 control-label">Sales Price / Unit<span style="color: red"></span></label>
                <div class="col-sm-9">
                    <input type="text" name="new_qkitem_sales_price_unit" class="form-control input-lg checkout_input" value="1" id="new_qkitem_sales_price_unit" placeholder="Units for above mentioned Price & UOM">
                </div>
              </div>
                <div id="res_op_mod1_new_qkitem"></div>
                
            </div> 
      </div>
      <div class="modal-footer"> 
          <div class="row">
              <div class="col-md-6"><a id="new_qkitem_addbtn"  class="col-md-6 btn btn-block btn-primary btn-lg">Back </a></div>
              <div class="col-md-6"><a id="new_qkitem_confirmbtn"  class="col-md-6 btn btn-block btn-primary btn-lg">Add Item</a></div>
          </div>
      </div> 
    </div>
  </div>
</div>  
<?php echo form_close();?>
<script>
    $(document).ready(function(){ 
        $('#items_add_new, #items_add_new2 ').click(function(){ 
           $('#add_qkitem_modal').modal({backdrop: 'static', keyboard: false }); 
        });
        $('#add_qkitem_modal').on('shown.bs.modal', function () {
            $('#new_qkitem_name').focus();
        })  
 
        
        $('#new_qkitem_addbtn').click(function(){
            $('#add_qkitem_modal').modal('toggle'); 
        }); 
        $('#new_qkitem_confirmbtn').click(function(){  
            
            if($('#new_qkitem_name').val()=='' || $('#new_qkitem_name').val().length<3){
                fl_alert('info',"Item Name Invalid!");
                $('#new_qkitem_name').focus().select();
                return false;
            }
            if($('#new_qkitem_sales_price').val()=='' || isNaN(parseFloat($('#new_qkitem_sales_price').val()))){
                fl_alert('info',"Sales Price Invalid!");
                $('#new_qkitem_sales_price').focus().select();
                return false;
            }
            add_quickitem_modal(); 
        });
        
    });
    
    function add_quickitem_modal(){
        var ret_val = 0; 
            $.ajax({
                url: "<?php echo site_url('Items/fl_ajax/');?>",
                type: 'post',
                data : {function_name:'create_quick_item',
                        category_id:$('#new_qkitem_category_id').val(),
                        item_name:$('#new_qkitem_name').val(),
                        uom_id:$('#new_qkitem_uom_id').val(),
                        tags:$('#new_qkitem_tags').val(),
                        sales_price:$('#new_qkitem_sales_price').val(), 
                        sales_price_unit:$('#new_qkitem_sales_price_unit').val(), 
                        },
                success: function(result){ 
//                    $('#res_op_mod1_new_qkitem').html(result); return false;
                     $.ajax({
                            url: "<?php echo site_url('Items/fl_ajax/');?>",
                            type: 'post',
                            data : {function_name:'get_dropdown_formodal'},
                            success: function(dd_data){  
                                
                                if(dd_data!=''){
                                    ret_val =1;
//                                    console.log(dd_data)
                                    var dd_options  = JSON.parse(dd_data); 
                                    var $select = $('#item_desc');    
                                    $.each(dd_options,function(index, o) { 
                                        var name = o.split(' | ');
                                        var option = $("<option/>").attr("value", index).text(name[0]); 
                                         $select.append(option); 
                                     });
                                    $('#item_desc').select2();  
                                    $('#add_qkitem_modal').modal('toggle'); 
                                    $('#item_desc').val(result).change();  
                                    $('#item_desc').trigger('change');  
                                }else{  
                                    fl_alert('info',"Something went wrong!");
                                }
                            }
                    });
                    
                }
            }); 
    }
</script>