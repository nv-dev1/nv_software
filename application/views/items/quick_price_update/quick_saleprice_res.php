
<div id="tes_re"></div>
<table id="example1" class="table dataTable11 table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Item Code</th>   
                <th>Item name</th> 
                <th>Category</th>   
                <th>Units for price</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
              <?php
                  $i = 0;
                   foreach ($search_list as $search){ 
//            echo '<pre>';            print_r($search); die; 
                       echo '
                           <tr id="tr_'.$search['id'].'">
                               <td>'.($i+1).'</td>
                               <td>'.$search['item_code'].'<input hidden id="itemid_'.$search['id'].'"  value="'.$search['id'].'"></td> 
                               <td>'.$search['item_name'].'</td> 
                               <td>'.$search['category_name'].'</td>  
                               <td><span class="units_txt">1</span> '.$search['unit_abbreviation'].'<br><input class="edit_mode unit_field hide"   type="number" id="priceunits_'.$search['id'].'" value="1"></td>
                               <td><span class="price_txt">'. number_format($search['price_amount'],2).'</span> <span style="color:green;" class="fl_notfic fa fa-check hide"></span><br><input class="edit_mode price_field hide"  type="number" id="itemprice_'.$search['id'].'" value="'. number_format($search['price_amount'],2).'"></td> 
                               <td>
                                  <a id="save_'.$search['id'].'"  title="Save" class="edit_mode fl_save_btn btn btn-success btn-xs hide"><span class="fa fa-check"></span></a>
                                  <a id="edit_'.$search['id'].'" title="Update" class="fl_edit_btn btn btn-default btn-xs"><span class="fa fa-edit"></span></a>
                                      
                               </td>  ';
                       $i++;
                   }
              ?>   
        </tbody>
           <tfoot>
           <tr>
                <th>#</th>
                <th>Item Code</th>   
                <th>Item name</th> 
                <th>Category</th>   
                <th>Units for price</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
           </tfoot>
         </table>
<script>
    $(document).ready(function() {
        
        $('.fl_edit_btn').click(function(){
            $('.edit_mode').addClass('hide');
            var itemid = (this.id).split('_')[1];
            $('#tr_'+itemid+' .edit_mode').removeClass('hide');
            $('#tr_'+itemid+' .fl_edit_btn').addClass('hide');
            
        });
        $('.fl_save_btn').click(function(){
            var itemid = (this.id).split('_')[1];
            var units = parseFloat($('#priceunits_'+itemid).val());
            var price = parseFloat($('#itemprice_'+itemid).val());
            
            if(price>0 && units>0){ 
                $.ajax({
                                url: "<?php echo site_url('Items/fl_ajax/');?>",
                                type: 'post',
                                data :{function_name:'update_quick_salesprice',item_id:itemid,units:units,price:price},
                                success: function(result){
                                     $("#tes_re").html(result);
                                     if(result!='0'){
                                         var amont = parseFloat(result).toFixed(2);
                                         $('#tr_'+itemid+' .edit_mode').addClass('hide');
                                         $('#tr_'+itemid+' .fl_edit_btn').removeClass('hide');
                                         $('#tr_'+itemid+' .fl_notfic').removeClass('hide');
                                         setTimeout(function() {
                                                                    $('#tr_'+itemid+' .fl_notfic').hide('blind', {}, 500)
                                                                }, 1000);
                                         $('#tr_'+itemid+' .units_txt').text(1);
                                         $('#tr_'+itemid+' .price_txt').text(amont);
                                         
                                     }else{
                                        fl_alert('danger',"Something went wrong!")
                                     }
        //                             $(".dataTable").DataTable();
                                }
                        });
            }else{
                
                fl_alert('warning',"Inputs Invalid! Please recheck.")
            }
            
            
        });
        $(".dataTable11").DataTable({"scrollX": true });
    })
</script>