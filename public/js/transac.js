$( document ).ready(function() {

    //add element to table
     $('#productPane').on("click", ".prodItems", function(){
         var id=$(this).data('id');
         var name = $(this).children('.prodName').html();
         var model = $(this).children('.prodDesc').children('.prodModel').html();
         var size = $(this).children('.prodDesc').children('.prodSize').html();
         transac.addToTransac (id,name, model, size);
         $(this).hide();
     });  
     
      $('#transacBody').on("click", ".delLine", function(){
          var id = $(this).parent().parent().data('id');
          $(this).parent().parent().remove();
          $('#list_'+id).show();     
       });  
       
       $('#newProductDialog').on('show.bs.open', function(){
            $('#flashMsg').hide();
            $('#addProduct').button('reset');
       });
       
       $('#newProd').click(function(){
           $('#newProductDialog').modal('show');
       });
       
       $('#addProduct').click(function(){
           //$(this).button('loading');
           $.post(mam.path+"product/addProduct", {'name':$('#name').val(),
                                              'model':$('#model').val(),
                                              'size':$('#size').val(),
                                              'notes':$('#notes').val()
                                        },
                function(data) {
                     if(data.status == 1)
                     {
                       addToProdList(data.id);  
                       $('#newProductDialog').modal('hide');
                     }
                     else
                     {
                       $('#flashMsg').html(data.message);
                       $('#flashMsg').fadeIn();
                     }
                   },'json');
       });    
});

function addToProdList(id)
{
    var html = '<a id="list_'+id+'" class="list-group-item prodItems" data-id="'+id+'" href="#">';
        html += '<h4 class="list-group-item-heading prodName">'+$('#name').val()+'</h4>';
        html += '<p class="list-group-item-text prodDesc">';
        html += '<span class="prodModel">'+$('#model').val()+'</span>:<span class="prodSize">'+$('#size').val()+'</span>';
        html += '</p></a>';
        $('#prodList').append(html);
}