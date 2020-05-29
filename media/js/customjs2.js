
window.onload = function () {

var chart1 = new CanvasJS.Chart("chartContainer1", {
    theme: "light2",
    animationEnabled: true,
 
    data: [{
        type: "pie",
        indexLabelFontSize: 12,
        radius: 70,
        indexLabel: "{label} - {y}",
        yValueFormatString: "###0.0\"%\"",
        click: explodePie,
        dataPoints: [
            { y: 42, label: "Active in a week" },
            { y: 21, label: "Active in a month"},
            { y: 24.5, label: "Active current" },
            { y: 9, label: "Inactive in a week" },
            { y: 3.1, label: "Inactive in a month" },
            { y: 3.1, label: "Inactive current" },
             { y: 9, label: "Dropped in a week" },
            { y: 3.1, label: "Dropped in a month" },
            { y: 3.1, label: "Dropped current" }
        ]
    }]
});




var chart2 = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,

    data: [{
        type: "pie",
        startAngle: 110,
        radius: 100,
        yValueFormatString: "##0.00\"%\"",
        indexLabel: "{label} {y}",
        dataPoints: [
            {y: 79.45, label: "10Rs<Ticket<50Rs"},
            {y: 7.31, label: "Ticket < 10Rs."},
            {y: 7.06, label: "Ticket > 50Rs."}

        ]
    }]
});



var chart3 = new CanvasJS.Chart("chartContainer2", {
    animationEnabled: true,
    theme: "light2",
    
    axisX:{
        valueFormatString: "DD MMM",
        crosshair: {
            enabled: true,
            snapToDataPoint: true
        }
    },
    
    toolTip:{
        shared:true
    },  
    legend:{
        cursor:"pointer",
        verticalAlign: "bottom",
        horizontalAlign: "left",
        dockInsidePlotArea: true,
        itemclick: toogleDataSeries
    },
    data: [{
        type: "line",
        showInLegend: true,
        name: "Total Matches",
        markerType: "square",
        xValueFormatString: "DD MMM, YYYY",
        color: "#F08080",
        dataPoints: [
            { x: new Date(2017, 0, 3), y: 650 },
            { x: new Date(2017, 0, 4), y: 700 },
            { x: new Date(2017, 0, 5), y: 710 },
            { x: new Date(2017, 0, 6), y: 658 },
            { x: new Date(2017, 0, 7), y: 734 },
            { x: new Date(2017, 0, 8), y: 963 },
            { x: new Date(2017, 0, 9), y: 847 },
            { x: new Date(2017, 0, 10), y: 853 },
            { x: new Date(2017, 0, 11), y: 869 },
            { x: new Date(2017, 0, 12), y: 943 },
            { x: new Date(2017, 0, 13), y: 970 },
            { x: new Date(2017, 0, 14), y: 869 },
            { x: new Date(2017, 0, 15), y: 890 },
            { x: new Date(2017, 0, 16), y: 930 }
        ]
    },
    {
        type: "line",
        showInLegend: true,
        name: "No. Of Transaction",
        lineDashType: "dash",
        dataPoints: [
            { x: new Date(2017, 0, 3), y: 510 },
            { x: new Date(2017, 0, 4), y: 560 },
            { x: new Date(2017, 0, 5), y: 540 },
            { x: new Date(2017, 0, 6), y: 558 },
            { x: new Date(2017, 0, 7), y: 544 },
            { x: new Date(2017, 0, 8), y: 693 },
            { x: new Date(2017, 0, 9), y: 657 },
            { x: new Date(2017, 0, 10), y: 663 },
            { x: new Date(2017, 0, 11), y: 639 },
            { x: new Date(2017, 0, 12), y: 673 },
            { x: new Date(2017, 0, 13), y: 660 },
            { x: new Date(2017, 0, 14), y: 562 },
            { x: new Date(2017, 0, 15), y: 643 },
            { x: new Date(2017, 0, 16), y: 570 }
        ]
    }]
});

var chart4 = new CanvasJS.Chart("chartContainer3", {
    animationEnabled: true,  
    title:{
        text: "ROI"
    },
    axisY: {
      
        valueFormatString: "#0,,.",
        suffix: "mn",
        stripLines: [{
            value: 3366500,
            label: "Average"
        }]
    },
    data: [{
        yValueFormatString: "#,### Units",
        xValueFormatString: "YYYY",
        type: "spline",
        dataPoints: [
            {x: new Date(2002, 0), y: 2506000},
            {x: new Date(2003, 0), y: 2798000},
            {x: new Date(2004, 0), y: 3386000},
            {x: new Date(2005, 0), y: 6944000},
            {x: new Date(2006, 0), y: 6026000},
            {x: new Date(2007, 0), y: 2394000},
            {x: new Date(2008, 0), y: 1872000},
            {x: new Date(2009, 0), y: 2140000},
            {x: new Date(2010, 0), y: 7289000},
            {x: new Date(2011, 0), y: 4830000},
            {x: new Date(2012, 0), y: 2009000},
            {x: new Date(2013, 0), y: 2840000},
            {x: new Date(2014, 0), y: 2396000},
            {x: new Date(2015, 0), y: 1613000},
            {x: new Date(2016, 0), y: 2821000},
            {x: new Date(2017, 0), y: 2000000}
        ]
    }]
});

var dps = [];
var chart5 = new CanvasJS.Chart("chartContainer4", {
    exportEnabled: true,
   
    axisY: {
        includeZero: false
    },
    data: [{
        type: "spline",
        markerSize: 0,
        dataPoints: dps 
    }]
});

var xVal = 0;
var yVal = 100;
var updateInterval = 1000;
var dataLength = 50; // number of dataPoints visible at any point

var updateChart = function (count) {
    count = count || 1;
    // count is number of times loop runs to generate random dataPoints.
    for (var j = 0; j < count; j++) {   
        yVal = yVal + Math.round(5 + Math.random() *(-5-5));
        dps.push({
            x: xVal,
            y: yVal
        });
        xVal++;
    }
    if (dps.length > dataLength) {
        dps.shift();
    }
   chart5.render();
};


var chart6 = new CanvasJS.Chart("chartContainer5", {
    animationEnabled: true,
     
    axisY: {
        title: "Per User Aquisition Cost",
        titleFontColor: "#4F81BC",
        lineColor: "#4F81BC",
        labelFontColor: "#4F81BC",
        tickColor: "#4F81BC"
    },
    axisY2: {
        title: "Daily New User Addition",
        titleFontColor: "#C0504E",
        lineColor: "#C0504E",
        labelFontColor: "#C0504E",
        tickColor: "#C0504E"
    },  
    toolTip: {
        shared: true
    },
    legend: {
        cursor:"pointer",
        itemclick: toggleDataSeries
    },
    data: [{
        type: "column",
      name: "Per User Aquisition Cost",
            legendText: "Per User Aquisition Cost",
        showInLegend: true, 
        dataPoints:[
         
            { label: "Jan", y: 302.25 },
            { label: "Feb", y: 157.20 },
            { label: "Mar", y: 157.20 },
            { label: "April", y: 148.77 },
            { label: "May", y: 101.50 },
            { label: "Jun", y: 97.8 },
            { label: "July", y: 302.25 },
            { label: "Aug", y: 157.20 },
            { label: "Sep", y: 148.77 },
            { label: "Oct", y: 101.50 },
             { label: "Nov", y: 148.77 },
            { label: "Dec", y: 101.50 }
           
        ]
    },
    {
        type: "column", 
        name: "Daily New User Addition",
            legendText: "Daily New User Addition",
        showInLegend: true, 
        axisYType: "secondary",
      
        dataPoints:[
            { label: "Jan", y: 10.46 },
            { label: "Feb", y: 2.27 },
            { label: "Mar", y: 3.99 },
            { label: "April", y: 4.45 },
            { label: "May", y: 2.92 },
            { label: "June", y: 2.92 },
             { label: "July", y: 10.46 },
            { label: "Aug", y: 2.27 },
            { label: "Sep", y: 3.99 },
            { label: "Oct", y: 4.45 },
            { label: "Nov", y: 2.92 },
            { label: "Dec", y: 3.1 }
        ]
    }]
});


var chart7 = new CanvasJS.Chart("chartContainer6", {
    animationEnabled: true,
    theme: "light2",

    axisX: {
        valueFormatString: "MMM"
    },
    axisY: {
        prefix: "$",
        labelFormatter: addSymbols
    },
    toolTip: {
        shared: true
    },
    legend: {
        cursor: "pointer",
        itemclick: toggleDataSeries
    },
    data: [
    {
        type: "column",
        name: "Average Revenue",
        showInLegend: true,
        xValueFormatString: "MMMM YYYY",
        yValueFormatString: "$#,##0",
        dataPoints: [
            { x: new Date(2016, 0), y: 20000 },
            { x: new Date(2016, 1), y: 30000 },
            { x: new Date(2016, 2), y: 25000 },
            { x: new Date(2016, 3), y: 70000, indexLabel: "Maximum" },
            { x: new Date(2016, 4), y: 50000 },
            { x: new Date(2016, 5), y: 35000 },
            { x: new Date(2016, 6), y: 30000 },
            { x: new Date(2016, 7), y: 43000 },
            { x: new Date(2016, 8), y: 35000 },
            { x: new Date(2016, 9), y:  30000},
            { x: new Date(2016, 10), y: 40000 },
            { x: new Date(2016, 11), y: 50000 }
        ]
    }, 
    {
        type: "line",
        name: "Expected",
        showInLegend: true,
        yValueFormatString: "$#,##0",
        dataPoints: [
            { x: new Date(2016, 0), y: 40000 },
            { x: new Date(2016, 1), y: 42000 },
            { x: new Date(2016, 2), y: 45000 },
            { x: new Date(2016, 3), y: 45000 },
            { x: new Date(2016, 4), y: 47000 },
            { x: new Date(2016, 5), y: 43000 },
            { x: new Date(2016, 6), y: 42000 },
            { x: new Date(2016, 7), y: 43000 },
            { x: new Date(2016, 8), y: 41000 },
            { x: new Date(2016, 9), y: 45000 },
            { x: new Date(2016, 10), y: 42000 },
            { x: new Date(2016, 11), y: 50000 }
        ]
    },
    {
        type: "area",
        name: "Profit",
        markerBorderColor: "white",
        markerBorderThickness: 2,
        showInLegend: true,
        yValueFormatString: "$#,##0",
        dataPoints: [
            { x: new Date(2016, 0), y: 5000 },
            { x: new Date(2016, 1), y: 7000 },
            { x: new Date(2016, 2), y: 6000},
            { x: new Date(2016, 3), y: 30000 },
            { x: new Date(2016, 4), y: 20000 },
            { x: new Date(2016, 5), y: 15000 },
            { x: new Date(2016, 6), y: 13000 },
            { x: new Date(2016, 7), y: 20000 },
            { x: new Date(2016, 8), y: 15000 },
            { x: new Date(2016, 9), y:  10000},
            { x: new Date(2016, 10), y: 19000 },
            { x: new Date(2016, 11), y: 22000 }
        ]
    }]
});


function addSymbols(e) {
    var suffixes = ["", "K", "M", "B"];
    var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

    if(order > suffixes.length - 1)                 
        order = suffixes.length - 1;

    var suffix = suffixes[order];      
    return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else {
        e.dataSeries.visible = true;
    }
    e.chart7.render();
}


var chart8 = new CanvasJS.Chart("chartContainer7", {
    animationEnabled: true,


    legend: {
        cursor:"pointer",
        itemclick : toggleDataSeries
    },
    toolTip: {
        shared: true,
        content: toolTipFormatter
    },
    data: [{
        type: "bar",
        showInLegend: true,
        name: "View",
        color: "brown",
        dataPoints: [
        { y: 24, label: "Dec" },
        { y: 2413, label: "Nov" },
        { y: 2, label: "Oct" },
        { y: 34, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 1243, label: "July" },
        { y: 62, label: "June" },
        { y: 345, label: "May" },
        { y: 45, label: "April" },
        { y: 789, label: "Mar" },
        { y: 999, label: "Feb" },
        { y: 1111, label: "Jan" }
        ]
    },
    {
        type: "bar",
        showInLegend: true,
        name: "Install",
        color: "silver",
        dataPoints: [
         { y: 243, label: "Dec" },
        { y: 243, label: "Nov" },
        { y: 243, label: "Oct" },
        { y: 243, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 243, label: "July" },
        { y: 236, label: "June" },
        { y: 243, label: "May" },
        { y: 273, label: "April" },
        { y: 269, label: "Mar" },
        { y: 196, label: "Feb" },
        { y: 1118, label: "Jan" }
        ]
    },
 ]
});


function toolTipFormatter(e) {
    var str = "";
    var total = 0 ;
    var str3;
    var str2 ;
    for (var i = 0; i < e.entries.length; i++){
        var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
        total = e.entries[i].dataPoint.y + total;
        str = str.concat(str1);
    }
    str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
    str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
    return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else {
        e.dataSeries.visible = true;
    }
    chart8.render();
}

var chart9 = new CanvasJS.Chart("chartContainer8", {
    animationEnabled: true,


    legend: {
        cursor:"pointer",
        itemclick : toggleDataSeries
    },
    toolTip: {
        shared: true,
        content: toolTipFormatter
    },
    data: [{
        type: "bar",
        showInLegend: true,
        name: "Install",
        color: "orange",
        dataPoints: [
        { y: 24, label: "Dec" },
        { y: 2413, label: "Nov" },
        { y: 2, label: "Oct" },
        { y: 34, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 1243, label: "July" },
        { y: 62, label: "June" },
        { y: 345, label: "May" },
        { y: 45, label: "April" },
        { y: 789, label: "Mar" },
        { y: 999, label: "Feb" },
        { y: 1111, label: "Jan" }
        ]
    },
    {
        type: "bar",
        showInLegend: true,
        name: "Registeration",
        color: "black",
        dataPoints: [
         { y: 243, label: "Dec" },
        { y: 243, label: "Nov" },
        { y: 243, label: "Oct" },
        { y: 243, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 243, label: "July" },
        { y: 236, label: "June" },
        { y: 243, label: "May" },
        { y: 273, label: "April" },
        { y: 269, label: "Mar" },
        { y: 196, label: "Feb" },
        { y: 1118, label: "Jan" }
        ]
    },
 ]
});


function toolTipFormatter(e) {
    var str = "";
    var total = 0 ;
    var str3;
    var str2 ;
    for (var i = 0; i < e.entries.length; i++){
        var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
        total = e.entries[i].dataPoint.y + total;
        str = str.concat(str1);
    }
    str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
    str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
    return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else {
        e.dataSeries.visible = true;
    }
    chart9.render();
}

var chart10 = new CanvasJS.Chart("chartContainer9", {
    animationEnabled: true,


    legend: {
        cursor:"pointer",
        itemclick : toggleDataSeries
    },
    toolTip: {
        shared: true,
        content: toolTipFormatter
    },
    data: [{
        type: "bar",
        showInLegend: true,
        name: "Registeration",
        color: "red",
        dataPoints: [
        { y: 24, label: "Dec" },
        { y: 2413, label: "Nov" },
        { y: 2, label: "Oct" },
        { y: 34, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 1243, label: "July" },
        { y: 62, label: "June" },
        { y: 345, label: "May" },
        { y: 45, label: "April" },
        { y: 789, label: "Mar" },
        { y: 999, label: "Feb" },
        { y: 1111, label: "Jan" }
        ]
    },
    {
        type: "bar",
        showInLegend: true,
        name: "Transaction",
        color: "blue",
        dataPoints: [
         { y: 243, label: "Dec" },
        { y: 243, label: "Nov" },
        { y: 243, label: "Oct" },
        { y: 243, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 243, label: "July" },
        { y: 236, label: "June" },
        { y: 243, label: "May" },
        { y: 273, label: "April" },
        { y: 269, label: "Mar" },
        { y: 196, label: "Feb" },
        { y: 1118, label: "Jan" }
        ]
    },
 ]
});


function toolTipFormatter(e) {
    var str = "";
    var total = 0 ;
    var str3;
    var str2 ;
    for (var i = 0; i < e.entries.length; i++){
        var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
        total = e.entries[i].dataPoint.y + total;
        str = str.concat(str1);
    }
    str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
    str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
    return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else {
        e.dataSeries.visible = true;
    }
    chart10.render();
}

var chart11 = new CanvasJS.Chart("chartContainer10", {
    animationEnabled: true,


    legend: {
        cursor:"pointer",
        itemclick : toggleDataSeries
    },
    toolTip: {
        shared: true,
        content: toolTipFormatter
    },
    data: [{
        type: "bar",
        showInLegend: true,
        name: "Shares",
        color:  "rgba(1,77,101,.1)",
        dataPoints: [
        { y: 24, label: "Dec" },
        { y: 2413, label: "Nov" },
        { y: 2, label: "Oct" },
        { y: 34, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 1243, label: "July" },
        { y: 62, label: "June" },
        { y: 345, label: "May" },
        { y: 45, label: "April" },
        { y: 789, label: "Mar" },
        { y: 999, label: "Feb" },
        { y: 1111, label: "Jan" }
        ]
    },
    {
        type: "bar",
        showInLegend: true,
        name: "Referals",
        color: "#014D65",
        dataPoints: [
         { y: 243, label: "Dec" },
        { y: 243, label: "Nov" },
        { y: 243, label: "Oct" },
        { y: 243, label: "Sep" },
        { y: 243, label: "Aug" },
        { y: 243, label: "July" },
        { y: 236, label: "June" },
        { y: 243, label: "May" },
        { y: 273, label: "April" },
        { y: 269, label: "Mar" },
        { y: 196, label: "Feb" },
        { y: 1118, label: "Jan" }
        ]
    },
 ]
});


function toolTipFormatter(e) {
    var str = "";
    var total = 0 ;
    var str3;
    var str2 ;
    for (var i = 0; i < e.entries.length; i++){
        var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
        total = e.entries[i].dataPoint.y + total;
        str = str.concat(str1);
    }
    str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
    str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
    return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else {
        e.dataSeries.visible = true;
    }
    chart11.render();
}



chart1.render();
chart2.render();
chart3.render();
chart4.render();
chart6.render();
chart7.render();
chart8.render();
chart9.render();
chart10.render();
chart11.render();



updateChart(dataLength); 
setInterval(function(){ updateChart() }, updateInterval); 


function explodePie(e) {
    for(var i = 0; i < e.dataSeries.dataPoints.length; i++) {
        if(i !== e.dataPointIndex)
            e.dataSeries.dataPoints[i].exploded = false;
    }
}
 

function toggleDataSeries(e) {
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else {
        e.dataSeries.visible = true;
    }
    chart6.render();
}



function toogleDataSeries(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else{
        e.dataSeries.visible = true;
    }
    chart3.render();
}
}


