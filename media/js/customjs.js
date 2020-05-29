
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Profit');
      data.addColumn('number', 'Gross');
      data.addColumn('number', 'Net');
      data.addColumn('number', 'Operating');

      data.addRows([
        [1,  37.8, 80.8, 41.8],
        [2,  30.9, 69.5, 32.4],
        [3,  25.4,   57, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [6,   8.8, 13.6,  7.7],
        [7,   7.6, 12.3,  9.6],
        [8,  12.3, 29.2, 10.6],
        [9,  16.9, 42.9, 14.8],
        [10, 12.8, 30.9, 11.6],
        [11,  5.3,  7.9,  4.7],
        [12,  6.6,  8.4,  5.2],
        [13,  4.8,  6.3,  3.6],
        [14,  4.2,  6.2,  3.4]
      ]);

      var options = {
      
        
        height: 500,
        axes: {
          x: {
            0: {side: 'bottom'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }






     google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
          ['Year', 'Gross', 'Net', 'Operating'],
          ['2004',  1000,    400,   400],
          ['2005',  1170,    460,   400],
          ['2006',  660,     1120,   400],
          ['2007',  1030,    540,   400]
        ]);

        var options1 = {
         
          curveType: 'function',
          legend: { position: 'bottom' }

        };

        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart1.draw(data1, options1);
      }




 google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Range', 'low and High'],
          ['A', 13], ['B', 83], ['c', 1.4],
          ['D', 2.3], ['G', 46], ['H', 300],
           ['e', 13], ['f', 83], ['J', 1.4],
          ['g', 2.3], ['G', 46], ['K', 300],
          ['S', 2.5], ['T', 61], ['Te', 74], ['U', 52]
        ]);

        var options = {
       
          legend: 'bottom',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }



 