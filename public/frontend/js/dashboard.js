 jQuery(document).ready(function($) {
   var url = $('#salesstat').data('url');
   $.ajax({
       url: url,
       type: 'GET',
     })
     .done(function(response) {
       /*console.log(response);*/
       Morris.Bar({
         element: 'salesstat',
         data: [
           { month: 'Janv.', y: splitDataCount(response[1]), price: splitDataPrice(response[1]) },
           { month: 'Févr.', y: splitDataCount(response[2]), price: splitDataPrice(response[2]) },
           { month: 'Mars', y: splitDataCount(response[3]), price: splitDataPrice(response[3]) },
           { month: 'Avril', y: splitDataCount(response[4]), price: splitDataPrice(response[4]) },
           { month: 'Mai', y: splitDataCount(response[5]), price: splitDataPrice(response[5]) },
           { month: 'Juin', y: splitDataCount(response[6]), price: splitDataPrice(response[6]) },
           { month: 'Juill.', y: splitDataCount(response[7]), price: splitDataPrice(response[7]) },
           { month: 'Aout', y: splitDataCount(response[8]), price: splitDataPrice(response[8]) },
           { month: 'Sept.', y: splitDataCount(response[9]), price: splitDataPrice(response[9]) },
           { month: 'Oct.', y: splitDataCount(response[10]), price: splitDataPrice(response[10]) },
           { month: 'Nov.', y: splitDataCount(response[11]), price: splitDataPrice(response[11]) },
           { month: 'Déc.', y: splitDataCount(response[12]), price: splitDataPrice(response[12]) },
         ],
         hoverCallback: function(index, options) {
           var row = options.data[index];
           return "<div class='text'>" + row.y + " ventes<br> " + row.price + " <i class='fa fa-eur'></i></div>";
         },
         xkey: 'month',
         ykeys: ['y'],
         labels: ['ventes'],
         barColors: ['#65BB9F'],
         xLabelMargin: 10
       });
       barFormat()
     })
     .fail(function(xhr) {})
     .always(function() {

     });
     var url_salescamembert = $('#salescamembert').data('url');
     $.ajax({
       url: url_salescamembert,
       type: 'GET',
     })
     .done(function(response) {
        /* console.log(response);*/
       var donut = Morris.Donut({
          element: 'salescamembert',
          data: [
            { label: 'en ligne', value: response.en_ligne.toFixed(2) },
            { label: 'locale', value: response.local.toFixed(2) }
          ],
          backgroundColor: '#ccc',
          labelColor: '#004857',
          colors: [
            '#65BB9F',
            '#044651'
          ],
          formatter: function(x) { return x + "%" }
        });
        donutFormat(response.en_ligne.toFixed(2), donut) 
     })
     .fail(function(xhr) {})
     .always(function() {

     });
 });

 function splitDataPrice($data) {
   if ($data == null) {
     return 0;
   }
   else {
     var result = $data.split('$');
     return result[1];
   }
 }

 function splitDataCount($data) {
   if ($data == null) {
     return 0;
   }
   else {
     var result = $data.split('$');
     return result[0];
   }
 }


 /*****   Mise en forme Bar chart  *****/
 function barFormat() {
   var path0 = $('#salesstat svg path:nth-of-type(1)');
   var paths = $('#salesstat svg path:not(path:nth-of-type(1))');
   var lastrect = $('#salesstat svg rect:last');
   console.log(lastrect.attr('fill'))
   path0.attr({ 'stroke': '#044651', 'stroke-width': '4' })
   paths.attr({ 'stroke': '#044651', 'stroke-width': '1' })
   path0.insertAfter(lastrect)
 }


 /*****   Mise en forme Donut chart  *****/
 function donutFormat(value1, donut) {
   var path1 = $('#salescamembert svg path:nth-of-type(1), #salescamembert svg path:nth-of-type(3)');
   path1.attr('stroke-width', '8')
   var path2 = $('#salescamembert svg path:nth-of-type(2), #salescamembert svg path:nth-of-type(4)');
   path2.attr('stroke', 'none')
   
   donut.select(0);
   $("#salescamembert text:first tspan").html(value1 + '%').attr('fill', '#65BB9F');
   $("#salescamembert text:last tspan").html("en ligne").css({
     'text-transform': 'uppercase',
     'font-size': '12px'
   });

   for (i = 0; i < donut.segments.length; i++) {
     donut.segments[i].handlers['hover'].push(function(i) {
       /*console.log(donut.data[i].value)*/
       $("#salescamembert text:first tspan").html(donut.data[i].value + "%").attr('fill', '#65BB9F');
       $("#salescamembert text:last tspan").html(donut.data[i].label).css({
         'text-transform': 'uppercase',
         'font-size': '12px'
       });
     });
   }
 }
 