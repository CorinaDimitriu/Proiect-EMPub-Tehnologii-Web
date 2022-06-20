//this is a node.js script
//you need to run 'npm install xhr2' first 

var XMLHttpRequest = require('xhr2');
const datarequesttest1 = async()=>{
  const post_id = 'one';
  const timescale = '3';
  var url = "http://127.0.0.1:9090/ords/useragent/get_stats/";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if(xhr.status==200){  
        console.log("control test passed");
      }else{console.log("control test failed");}
    }
  };
  var data = '{"post_id":"'+post_id+'","timescale":"'+timescale+'"}';
  xhr.send(data);
};

//post that doesn't exist
const datarequesttest2 = async()=>{
  const post_id = 'theresnowaythispostexists';
  const timescale = '3';
  var url = "http://127.0.0.1:9090/ords/useragent/get_stats/";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if(xhr.status==200){
        const json = JSON.parse(xhr.responseText);
        const x_ret=json.x_ret;
        if(x_ret.length==0) console.log("nonexistent post: test passed");
        else console.log("nonexistent post: test failed");
      }else console.log("nonexistent post: test failed");
    }
  };
  var data = '{"post_id":"'+post_id+'","timescale":"'+timescale+'"}';
  xhr.send(data);
};

//connection issues
const datarequesttest3 = async()=>{
  const post_id = 'theresnowaythispostexists';
  const timescale = '3';
  var url = "http://8.8.8.8:9090/ords/useragent/get_stats/";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status==200) {
      console.log("wrong address or server not running error test failed");
    }else console.log("wrong address or server not running error test successful");
  };
  var data = '{"post_id":"'+post_id+'","timescale":"'+timescale+'"}';
  xhr.send(data);
};

//incorrect link
const datarequesttest4 = async()=>{
  const post_id = 'theresnowaythispostexists';
  const timescale = '3';
  var url = "http://127.0.0.1:9090/ords/useragent/get_stat";
  //the error is here                             ^^^^
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if(xhr.status==404) console.log("incorrect link test successful");
      else console.log("incorrect link test failed");
    }
  };
  var data = '{"post_id":"'+post_id+'","timescale":"'+timescale+'"}';
  xhr.send(data);
};

//wrong timescale
const datarequesttest5 = async()=>{
  const post_id = 'theresnowaythispostexists';
  const timescale = '6';
  var url = "http://127.0.0.1:9090/ords/useragent/get_stats/";
  var xhr = new XMLHttpRequest();
  xhr.open("POST", url);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if(xhr.status==200){
        const json = JSON.parse(xhr.responseText);
        const x_ret=json.x_ret;
        if(x_ret.length==0) console.log("wrong timescale test successful");
        else console.log("wrong timescale test failed");
      } else console.log("wrong timescale test failed");
    }
  };
  var data = '{"post_id":"'+post_id+'","timescale":"'+timescale+'"}';
  xhr.send(data);
};


datarequesttest1();
datarequesttest2();
datarequesttest3();
datarequesttest4();
datarequesttest5();
