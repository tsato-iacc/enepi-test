/**
 * Google chart
 */
if ($('#simulation_chart').length) {
  google.charts.load('current', {'packages':['corechart']});
      
  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);
    
  function drawChart() {
    var jsonData = $('input[name=google_chart_json_data]').val();
    console.log(jsonData);
        
    // Create our data table out of JSON data loaded from server.
    var data = new google.visualization.DataTable(jsonData);

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('simulation_chart'));
    chart.draw(data, {width: "100%", height: 300, title: "地域平均とエネピ利用時の削減シミュレーション"});
  }
}
