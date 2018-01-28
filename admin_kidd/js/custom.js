 $(document).ready(function(){
                  
                  $('table#categories-tbl tr td a').on('click',function(e){
                      e.preventDefault();
                      
                      var action_type = $(this).attr('data-action-type');
                      var category_id = $(this).attr('data-category-id');
                      
                      
                      
                      if(action_type == 'edit'){
                          location.replace('edit_category.php?id='+category_id);
                          
                      }
                      else if(action_type == 'delete'){
                          $('#myModal').modal('show');
                          
                        
                          $('button').on('click',function(e){
                              e.preventDefault();
                              var action_type = $(this).attr('data-action-type');
                              if(action_type=='delete_ok'){
                              
                              $.ajax({
                      url:"del_category.php",
                      method:"POST",
                      data: { 'id': category_id},
                      dataType:"",
                      success:function(data){
                          //hide modal
                          $('#myModal').modal('hide');
                          //reload categories table
                          $('#categories-tbl').html(data);
                               
                      }
                  });
                             
                              }
                          });
                      
                         
                      }
                      
                  });
                  
                  
    });