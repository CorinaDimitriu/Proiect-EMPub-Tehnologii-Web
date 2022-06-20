//Chart.defaults.global.defaultFontColor = "black";

const requestDataTime = async()=>{
  const post_id = 'one';
  const timescale = document.getElementById('viewsdatascope').value;
  var url = "http://127.0.0.1:9090/ords/useragent/get_stats/";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {  
      var date = new Date(Date.now());
      const json = JSON.parse(xhr.responseText);
      let rawtimedata =[];
      let rawtimedata2 = [];

      if(timescale==1){
        //only add data from the last hour to the graph
        for(var i = 0; i < 60; i++){
          rawtimedata.push(0);
        }
        for(var i = 0; i < json.x_ret.length; i++){
          //map each element to the respective minute
          const item = Date.parse(new String(json.x_ret[i]).split('#')[0])-date.getTimezoneOffset()*60*1000;
          rawtimedata[new Date(item-date).getUTCMinutes()]++;
        } 
        for(var i = 0; i < rawtimedata.length; i++){
          rawtimedata2.push({x:date-i*60*1000, y:rawtimedata[rawtimedata.length-i-1]});
        }
      }else if(timescale==2){
        //only add data from the last day to the graph
        
        for(var i = 0; i < 24; i++){
          rawtimedata.push(0);
        }
        for(var i = 0; i < json.x_ret.length; i++){
          //map each element to the respective hour
          const item = new Date(Date.parse(new String(json.x_ret[i]).split('#')[0])-date.getTimezoneOffset()*60*1000);
          rawtimedata[new Date(item-date).getUTCHours()]++;
        }
        for(var i = 0; i < rawtimedata.length; i++){
          rawtimedata2.push({x:date-i*60*60*1000, y:rawtimedata[rawtimedata.length-i-1]});
        }
      }else if(timescale==3){
        //only add data from the last week to the graph
        for(var i = 0; i < 7; i++){
          rawtimedata.push(0);
        }
        for(var i = 0; i < json.x_ret.length; i++){
          //map each element to the respective day
          const item = new Date(Date.parse(new String(json.x_ret[i]).split('#')[0])-date.getTimezoneOffset()*60*1000);
          const diff = (date-item)/(1000*60*60*24);
          rawtimedata[6-Math.floor(diff)]++;
        }
        for(var i = 0; i < rawtimedata.length; i++){
          rawtimedata2.push({x:date-i*24*60*60*1000, y:rawtimedata[rawtimedata.length-i-1]});
        }
      }else if(timescale==4){
        //only add data from the last month to the graph
        for(var i = 0; i < 30; i++){
          rawtimedata.push(0);
        }
        for(var i = 0; i < json.x_ret.length; i++){
          //map each element to the respective day
          const item = new Date(Date.parse(new String(json.x_ret[i]).split('#')[0])-date.getTimezoneOffset()*60*1000);
          const diff = (date-item)/(1000*60*60*24);
          rawtimedata[29-Math.floor(diff)]++;
        }
        for(var i = 0; i < rawtimedata.length; i++){
          rawtimedata2.push({x:date-i*24*60*60*1000, y:rawtimedata[rawtimedata.length-i-1]});
        }
      }else if(timescale==5){
        //only add data from the last year to the graph
        for(var i = 0; i < 12; i++){
          rawtimedata.push(0);
        }
        for(var i = 0; i < json.x_ret.length; i++){
          //map each element to the respective month
          const item = new Date(Date.parse(new String(json.x_ret[i]).split('#')[0])-date.getTimezoneOffset()*60*1000);
          const diff = (date-item)/(1000*60*60*24*30);
          rawtimedata[11-Math.floor(diff)]++;
        }
        for(var i = 0; i < rawtimedata.length; i++){
          rawtimedata2.push({x:date-i*60*60*24*1000*30*12, y:rawtimedata[rawtimedata.length-i-1]});
        }
      }
      try{Chart.getChart('viewsovertime').destroy();}catch(e){
        console.log('no chart yet. skipping...')
      }
      let scopestring;
      if(timescale == "1"){
        scopestring='minute';
      }else if(timescale == "2"){
        scopestring='hour';
      }else if(timescale == "3"){
        scopestring='day';
      }else if(timescale == "4"){
        scopestring='day';
      }else if(timescale == "5"){
        scopestring='month';
      }

      new Chart("viewsovertime", {
        type: "line",
        data: {
          datasets: [{
            backgroundColor: "rgb(78,8,142)",
            borderColor: "rgba(0,0,0,0.5)",
            data: rawtimedata2,
            label: 'views over time'
          }]
        },
        options: {
          scales: {
            x: {
              type: 'time',
              time: {
                unit: scopestring,
              },
            },
            y: {
              beginAtZero: true
            }
          }
        }
      });

      for(var i = 0; i < rawtimedata2.length; i++){
        rawtimedata2[i].x = new Date(rawtimedata2[i].x).toLocaleString();
      }

      //write the data in rawtimedata2 to a pdf file
      const doc = new jsPDF();
      for(var i = 0; i < rawtimedata2.length; i++){
        doc.text(new String(rawtimedata2[i].x+' => '+rawtimedata2[i].y).toString(), 10, 10+i*10);
      }
      //var text = JSON.stringify(rawtimedata2);
      //doc.text(text, 10, 10);
      document.getElementById('dl_pdfview').onclick=()=>doc.save('views.pdf');

      //write the data in rawtimedata2 to an html file
      var html = '<html><head><title>Views over time</title></head><body><h1>Views over time</h1><table><tr><th>Time</th><th>Views</th></tr>';
      for(var i = 0; i < rawtimedata2.length; i++){
        html += '<tr><td>'+rawtimedata2[i].x+'</td><td>'+rawtimedata2[i].y+'</td></tr>';
      }
      html += '</table></body></html>';
      document.getElementById('dl_htmlview').onclick=()=>{
        var a = document.createElement('a');
        a.href = 'data:attachment/html,' + encodeURIComponent(html);
        a.target = '_blank';
        a.download = 'views_over_time.html';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      }

      //write the data in rawtimedata2 to an xml file

      var xml = '<xml><views>';
      for(var i = 0; i < rawtimedata2.length; i++){
        xml += '<view><time>'+rawtimedata2[i].x+'</time><views>'+rawtimedata2[i].y+'</views></view>';
      }
      xml += '</views></xml>';
      document.getElementById('dl_xmlview').onclick=()=>{
        var a = document.createElement('a');
        a.href = 'data:attachment/xml,' + encodeURIComponent(xml);
        a.target = '_blank';
        a.download = 'views_over_time.xml';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      }
    }};
  var data = '{"post_id":"'+post_id+'","timescale":"'+timescale+'"}';
  xhr.send(data);
};
requestDataTime();

document.getElementById('viewsdatascope').addEventListener('change', requestDataTime);


const requestDataCountries = async() => {
  const post_id = 'one';
  const timescale = document.getElementById('countrydatascope').value;
  var url = "http://127.0.0.1:9090/ords/useragent/get_stats/";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {  
      const timescale = document.getElementById('countrydatascope').value;
      const json = JSON.parse(xhr.responseText);
      const viewsPerCountry = {};
      for(var i = 0; i < json.x_ret.length; i++){
        const item = new String(json.x_ret[i]).split('#')[1];
        if(viewsPerCountry[item] == undefined){
          viewsPerCountry[item] = 1;
        }else{
          viewsPerCountry[item]++;
        }
      }
      const x = [];
      const y = [];
      var i = 0;
      for(var key in viewsPerCountry){
        x.push(key);
        y.push(viewsPerCountry[key]);
      }


      try{Chart.getChart('viewsbycountry').destroy();}catch(e){
        console.log('no chart yet. skipping...')
      }

      let scopestring;
      if(timescale == "1"){
        scopestring='minute';
      }else if(timescale == "2"){
        scopestring='hour';
      }else if(timescale == "3"){
        scopestring='day';
      }else if(timescale == "4"){
        scopestring='day';
      }else if(timescale == "5"){
        scopestring='month';
      }

      var barColors = ["rgb(61, 5, 112)", "rgb(78,8,142)", "rgb(103, 34, 166)", "rgb(145, 58, 226)", "rgb(172, 127, 243)"];

      new Chart("viewsbycountry", {
        type: "bar",
        fontColor: "black",
        data: {
          labels: x,
          datasets: [{
            backgroundColor: barColors,
            borderWidth: 5,
            data: y,
            label: 'countries of visitors'
          }]
        },
        options: {}
    
      });

      //write to pdf file
      const doc = new jsPDF();
      var vertical = 10;
      for(var key in viewsPerCountry){
        doc.text(key+': '+viewsPerCountry[key], 10, vertical);
        vertical += 10;
      }
      document.getElementById('dl_pdfcountry').onclick=()=>doc.save('countries.pdf');

      //write to html file
      var html = '<html><head><title>Countries of visitors</title></head><body><h1>Countries of visitors</h1><table><tr><th>Time</th><th>Views</th></tr>';
      for(var i = 0; i < x.length; i++){
        html += '<tr><td>'+x[i]+'</td><td>'+y[i]+'</td></tr>';
      }
      html += '</table></body></html>';
      document.getElementById('dl_htmlcountry').onclick=()=>{
        var a = document.createElement('a');
        a.href = 'data:attachment/html,' + encodeURIComponent(html);
        a.target = '_blank';
        a.download = 'countries_of_visitors.html';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      }

      //write the data in rawtimedata2 to an xml file
      var xml = '<xml><countries>';
      for(var i = 0; i < x.length; i++){
        xml += '<country><time>'+x[i]+'</time><views>'+y[i]+'</views></country>';
      }
      xml += '</countries></xml>';
      document.getElementById('dl_xmlcountry').onclick=()=>{
        var a = document.createElement('a');
        a.href = 'data:attachment/xml,' + encodeURIComponent(xml);
        a.target = '_blank';
        a.download = 'countries_of_visitors.xml';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      }
    }};
  var data = '{"post_id":"'+post_id+'","timescale":"'+timescale+'"}';
  xhr.send(data);
}
requestDataCountries();

document.getElementById('countrydatascope').addEventListener('change', requestDataCountries);

/*
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 16];
var barColors = ["rgb(61, 5, 112)", "rgb(78,8,142)", "rgb(103, 34, 166)", "rgb(145, 58, 226)", "rgb(172, 127, 243)"];

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
});*/