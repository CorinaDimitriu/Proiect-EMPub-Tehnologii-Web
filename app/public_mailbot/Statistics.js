Chart.defaults.global.defaultFontColor = "black";

var xValues = ["0:00","1:00","2:00","3:00","4:00","5:00","6:00","7:00","8:00","9:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"];
var yValues = [20,10,5,4,8,2,2,9,10,20,25,30,60,27,52,70,70,52,67,78,34,41,12,25];

new Chart("viewsovertime", {
            type: "line",
            data: {
            labels: xValues,
            datasets: [{
                    backgroundColor: "rgb(78,8,142)",
                    borderColor: "rgba(0,0,0,0.5)",
                    data: yValues,
                    label: 'views over time'
                    }]
            },
            options:{}
        });

var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 16];
var barColors = ["rgb(61, 5, 112)", "rgb(78,8,142)","rgb(103, 34, 166)","rgb(145, 58, 226)","rgb(172, 127, 243)"];

new Chart("viewsbycountry", {
            type: "bar",
            fontColor: "black",
            data: {
            labels: xValues,
            datasets: [{
                    backgroundColor: barColors,
                    borderWidth: 5,
                    data: yValues,
                    label: 'countries of visitors'
                    }]
            },
            options: {}
        });