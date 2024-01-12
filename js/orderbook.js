
$(function(){
    // $('.size-input').mask('#,###.##',{reverse:true});
 var totalQty= function(){
     var sum=0;
     $('.size-input').each(function(){
         var num=$(this).val().replace(',','');
         if(num!=0){
             sum+=parseInt(num);
         }
     });
 $('#totalqty').val(sum);
 }
 $('.size-input').keyup(function(){
     totalQty();
 });});