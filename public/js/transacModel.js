var transac = {
    selectedItems : new Array(),
    
    addToTransac : function(id,name, model, size){
        var html = '<tr data-id="'+id+'" id="row_'+id+'">';
        html += '<td>'+name+'</td>';
        html += '<td>'+model+'</td>';
        html += '<td>'+size+'</td>';
        html += '<td><input type="text" size="5" class="tQty" /></td>';
        html += '<td><input type="text" size="5" class="tTotal" /></td>';
        html += '<td class="tPriceSup">price (supplier)</td>';
        html += '<td class="tPriceAll">price (general)</td>';
        html += '<td><button type="button" class="btn btn-danger btn-xs delLine"><span class="glyphicon glyphicon-remove"></span></button></td>';
        html += '</tr>';
        $('#transacBody').append(html);
        
        //after appending start searching for best price available so that it is available for later user
    }
}

