$( document ).ready(function() {
    console.log(searchSource);
    $('#searchTxt').typeahead({
    source: function (query, process) {
        usersSch = [];
        map = {};
        
        var data = searchSource;
        
        $.each(data, function (i, state) {
        map[state.searchTxt] = state;
        usersSch.push(state.searchTxt);
    });
 
    process(usersSch);
    },
    updater: function (item) {
        selectedState = map[item].reference;        
        scrollToAnimate(selectedState);
        return item;
    },
    matcher: function (item) {
        if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
        return true;
        }
    },
    sorter: function (items) {
        return items.sort();
    },
    highlighter: function (item) {
       var regex = new RegExp( '(' + this.query + ')', 'gi' );
       return item.replace( regex, "<strong>$1</strong>" );
    },
});


$('#searchTxt').click(function(){
    $(this).select();
});

$('.tt-query').css('background-color','#fff');


/*

	$('#query').typeahead({        
        local: ['alpha','allpha2','alpha3','bravo','charlie','delta','epsilon','gamma','zulu']
	});                                                                                                                                                                                                                                                         
*/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

});


function scrollToAnimate(id)
{
  var position =  $("#"+id).offset().top - 100;
  $('html, body').animate({
        scrollTop: position
      }, 500, function() {
        $('#'+id).effect("highlight", {color: '#0088CC'}, 1000);
      });
}