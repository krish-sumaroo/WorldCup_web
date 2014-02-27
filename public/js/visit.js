$( document ).ready(function() {
        $('#newVisit').click(function () {
           $('#supplier').modal('show');
        });

        $('#supplier').on('show.bs.modal', function(){
            $('#flashMsg').hide();
            $('#frmSupplier')[0].reset();
            $('#addSupplier').button('reset');
        });

        
        
         $('#addSupplier').click(function () {
          $(this).button('loading');
           var postedValsArr = $('#frmSupplier').serializeArray();
           var today = $('#dayVisit').data("day");
           var daySelected = $('#dayVisit').val();
           var name = $('#name').val();
           $.post(path+"supplier/addSupplier", { elements:JSON.stringify(postedValsArr)},
           function( data ) {
                if(data.status == 1)
                {
                  $('#supplier').modal('hide');
                  if(today == daySelected)
                  {
                      addToList(data.id, name);
                      console.log('adding');
                  }
                }
                else
                {
                  $('#flashMsg').html(data.message);
                  $('#flashMsg').fadeIn();
                }
              },'json');
        });
        
     $('#lstSupplier').on("click", ".itemSupplier", function(){
     

     });    
        
});
 
 function addToList(id, name)
 {
     var html = '<li class="list-group-item" data-id="'+id+'">'+name+'</li>';
     $('#lstSupplier').append(html);
 }
    