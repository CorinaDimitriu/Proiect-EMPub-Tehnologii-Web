document.getElementById("stats_trigger").addEventListener('mouseenter',function(event) {
    var x  = event.pageX;
    var y  = event.pageY;
    document.getElementById("explanation_stats_email").style.visibility = "visible";
    document.getElementById("explanation_stats_email").style.top = `${y}px`;
    document.getElementById("explanation_stats_email").style.left = `${x+5}px`;
  },false)
  
  document.getElementById("stats_trigger").addEventListener('mouseout',function(event) {
    document.getElementById("explanation_stats_email").style.visibility = "hidden";
  },false)