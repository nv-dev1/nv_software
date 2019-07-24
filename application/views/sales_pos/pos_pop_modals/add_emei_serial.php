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
   
<div class="modal fade" id="add_emei_modal"   role="dialog" aria-labelledby="exampleModalLabel_Emei" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel_Emei">EMEI / SERIAL
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </h5>

      </div> 
      <div class="modal-body form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="city" class="col-sm-3 control-label">Type</label>
                <div class="col-sm-9"> 
                    <?php  echo form_dropdown('add_emeitype',array("EMEI"=>"EMEI No","SERIAL"=>'Serial No'),set_value('add_emeitype'),'style="width:100%" class="form-control input-lg select2" data-live-search="true" id="add_emeitype"');?> 
                </div>
              </div> 
              <div class="form-group">
                <label for="add_emeiserial" class="col-sm-3 control-label">EMEI/Serial<span style="color: red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="add_emeiserial" class="form-control input-lg " id="add_emeiserial" placeholder="Enter Serial or EMEI No..">
                    <input  type="text" name="add_emeiserial_row" class="form-control input-lg hide " id="add_emeiserial_row">
                </div>
              </div>     
              
                <div id="res_op_mod2"></div>
                
            </div> 
      </div>
      <div class="modal-footer"> 
          <div class="row">
              <div class="col-md-6"><a id="back_add_emei"  class="col-md-6 btn btn-block btn-primary btn-lg">Back </a></div>
              <div class="col-md-6"><a id="confirm_add_emei"  class="col-md-6 btn btn-block btn-primary btn-lg">Add EMEI/SEERIL</a></div>
          </div>
      </div> 
    </div>
  </div>
</div>  
<?php echo form_close();?>
<script>
    $(document).ready(function(){  
        $('#add_emei_modal').on('shown.bs.modal', function () {
            $('#add_emeiserial').focus();
        })  
 
        
        $('#back_add_emei').click(function(){
            $('#add_emei_modal').modal('toggle'); 
        }); 
        $('#confirm_add_emei').click(function(){  
            
            if($('#add_emeiserial').val()=='' || $('#add_emeiserial').val().length<3){
                fl_alert('info',"Serial or Emei Number Invalid!");
                $('#add_emeiserial').focus().select();
                return false;
            } 
            
            var tr_id = $('#add_emeiserial_row').val(); 
            var emei_no = $('#add_emeiserial').val(); 
            var emei_type = $('#add_emeitype').val(); 
            
            $('#'+tr_id+" .add_emei_txt_cls").html('<i class="rm-emei fa fa-trash"></i>'+emei_type+": "+emei_no);
            $('#'+tr_id+" .input_emei_field").val(emei_no);
            
            recalculate_line();
             $('.rm-emei').click(function(){ //remove emei 
                var tr_id = $(this).closest('tr').attr('id');
                $('#'+tr_id+" .input_emei_field").val("");
                $('#'+tr_id+" .add_emei_txt_cls").html(""); 
            });
            $('#add_emei_modal').modal('toggle'); 
//            if(tr_id)
//            alert(tr_id); return false;
        });
       
        
    });
     
</script>