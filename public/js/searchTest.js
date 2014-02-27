$( document ).ready(function() {

    /*
    $('.typeahead').typeahead({
        name: 'Some name',
        local: [{
            value: 'JakeHarding',
            tokens: ['Jake', 'Harding'],
            name: 'Jake Harding',
            id :2
        },
        {
            value: 'Tits',
            tokens: ['Fuck', 'Me'],
            name: 'Asshole',
            id: 5
        }],
        template: "<p><strong>{{name}}</strong>", //Typeahead inline template
        engine: Hogan
    }).on("typeahead:selected", function($e, datum){ //What to do on select
        console.log(datum.id);
    });
    */

    $(".typeahead").typeahead({
        name: "customers", //Local storage name so that other parts of your site don't need to make a request if we already have it
        prefetch: mam.path+"main/testSearchJSON", //Limited to last 1000 updated contacts
        limit: 10, //This is the limit displayed not returned
        template: "<p><strong>{{name}}</strong>", //Typeahead inline template
        engine: Hogan,
    }).on("typeahead:selected", function($e, datum){ //What to do on select
        console.log(datum['id']);
    });



})


var data = {
  value: '@JakeHarding',
  tokens: ['Jake', 'Harding']
};

