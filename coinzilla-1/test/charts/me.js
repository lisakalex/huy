
// const hyip_pie_da=document.currentScript.dataset.hyip_pie;
// const hyip_rgaph_da=document.currentScript.dataset.hyip_rgaph;
const hyip_graph_total_da=document.currentScript.dataset.hyip_graph_total;
// debugger;
// chart total xxxxxxxxxxxxxxxxxxxxxxxx
// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
    am5themes_Animated.new(root)
]);

// debugger;
// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart1 = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    maxTooltipDistance: 0,
    pinchZoomX: true
    // chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
}));


function generateData() {
    value = Math.round((Math.random() * 10 - 4.2) + value);
    am5.time.add(date, "day", 1);
    // debugger;
    return {
        date: date.getTime(),
        value: value
    };

}

function generateDatas(count) {
    // var data = [];
    for (var i = 0; i < count; ++i) {
        data.push(generateData());
        // debugger;
    }
    return data;
}

// var data = [];
// data.push([
//     {
//         "date": 1677456000000,
//         "value": -2
//     },
//     {
//         "date": 1677542400000,
//         "value": 3.json
//     },
//     {
//         "date": 1677628800000,
//         "value": 8
//     },
//     {
//         "date": 1677715200000,
//         "value": 6
//     }
// ]);
// data.push([
//     {
//         "date": 1677456000000,
//         "value": -3.json
//     },
//     {
//         "date": 1677542400000,
//         "value": 5
//     },
//     {
//         "date": 1677628800000,
//         "value": 6
//     },
//     {
//         "date": 1677715200000,
//         "value": 9
//     }
// ]);
var data = [];
data = JSON.parse(hyip_graph_total_da)


debugger;

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart1.xAxes.push(am5xy.DateAxis.new(root, {
    maxDeviation: 0.2,
    baseInterval: {
        timeUnit: "day",
        count: 1
    },
    renderer: am5xy.AxisRendererX.new(root, {}),
    tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart1.yAxes.push(am5xy.ValueAxis.new(root, {
    renderer: am5xy.AxisRendererY.new(root, {})
}));


// debugger;
// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
for (let i = 0; i < data.length; i++) {
    // debugger;
    var series = chart1.series.push(am5xy.LineSeries.new(root, {
        name: data[i][0]["hyip"],
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        valueXField: "date",
        legendValueText: "{valueY}",
        tooltip: am5.Tooltip.new(root, {
            pointerOrientation: "horizontal",
            labelText: "{valueY}"
        })
    }));
    // debugger;
    // date = new Date();
    // date.setHours(0, 0, 0, 0);
    // value = 0;
    // var data = generateDatas(100);
    // series.data.setAll(data);

    date = data[i][0]["date"];
    // date.setHours(0, 0, 0, 0);
    value = data[i][0]['value'];
    series.data.setAll(data[i]);

    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear();
    debugger;
}

// for (let i = 0; i < da.length; i++)
//     console.log(i + ". " + da[i]);
//
// document.getElementById("demo").innerHTML = da.toString();

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart1.set("cursor", am5xy.XYCursor.new(root, {
    behavior: "none"
}));
cursor.lineY.set("visible", false);


// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart1.set("scrollbarX", am5.Scrollbar.new(root, {
    orientation: "horizontal"
}));

// chart.set("scrollbarY", am5.Scrollbar.new(root, {
//     orientation: "vertical"
// }));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart1.rightAxesContainer.children.push(am5.Legend.new(root, {
    width: 200,
    paddingLeft: 15,
    height: am5.percent(100)
}));

// When legend item container is hovered, dim all the series except the hovered one
legend.itemContainers.template.events.on("pointerover", function (e) {
    var itemContainer = e.target;

    // As series list is data of a legend, dataContext is series
    var series = itemContainer.dataItem.dataContext;

    chart1.series.each(function (chartSeries) {
        if (chartSeries != series) {
            chartSeries.strokes.template.setAll({
                strokeOpacity: 0.15,
                stroke: am5.color(0x000000)
            });
        } else {
            chartSeries.strokes.template.setAll({
                strokeWidth: 3
            });
        }
    })
})

// When legend item container is unhovered, make all series as they are
legend.itemContainers.template.events.on("pointerout", function (e) {
    var itemContainer = e.target;
    var series = itemContainer.dataItem.dataContext;

    chart1.series.each(function (chartSeries) {
        chartSeries.strokes.template.setAll({
            strokeOpacity: 1,
            strokeWidth: 1,
            stroke: chartSeries.get("fill")
        });
    });
})

legend.itemContainers.template.set("width", am5.p100);
legend.valueLabels.template.setAll({
    width: am5.p100,
    textAlign: "right"
});

// It's is important to set legend data after all the events are set on template, otherwise events won't be copied
legend.data.setAll(chart1.series.values);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart1.appear(1000, 100);
