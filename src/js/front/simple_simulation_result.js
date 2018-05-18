/**
 * Simple simulation result page
 */
if ($('.simple-simulation-result').length) {

  /**
   * Google chart
   */
  google.charts.load('current', {'packages':['corechart']});
      
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);
    
  function drawChart() {
    var jsonData = $('input[name=google_chart_json_data]').val();
            
    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('simulation_chart'));
    chart.draw(data, {width: "100%", height: 300, title: ""});
  }

  var cId = 1;

  var counterOptions = {
    useEasing : true,
    useGrouping : true,
    separator : ',',
    decimal : '.',
  };

  // Run counting
  $('.simulation-counter').each(function() {
    var start = $(this).attr('data-start');
    var end   = $(this).attr('data-end');
    var dec   = $(this).attr('data-dec');
    var skip  = $(this).attr('data-skip');

    $(this).find('span.target').attr('id', 'cId-' + cId);

    if (skip == 'false') {
      new CountUp('cId-' + cId, start, end, dec, 1, counterOptions).start();
    }

    cId++;
  });
}
