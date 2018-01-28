$(document).ready(function(){

    $(document).on('click',('#post'),function(){
        var name=$('#name').val();
        var comment=$('#comment').val();
        $.ajax({
         url:"database.php",
         method:"POST",
         data:{
          'save':1,
          'name':name,
          'comment':comment
         },
         success:function(response){
             $('#name').val('');
             $('#comment').val('');
             $('#shouts').append(response);
         }
        });
    });
    
});