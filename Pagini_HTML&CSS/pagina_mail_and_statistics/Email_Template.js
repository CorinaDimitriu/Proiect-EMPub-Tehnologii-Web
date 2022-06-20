document.getElementById("smallerMenu").addEventListener('click', function(event) {
 document.getElementById("menu").style.display="initial";
 document.getElementById("menu").style.position="absolute";},false);

document.getElementById("menu").addEventListener('click', function (event) {
  event.stopPropagation();
});

document.getElementById("menu_closer").addEventListener('click', function (event) {
  if(window.screen.width < 751)
     document.getElementById("menu").style.display = "none";
});

window.addEventListener('resize',function(event) {
  if(window.screen.width > 750) {
     document.getElementById("menu").style.display = "initial";
     document.getElementById("menu").style.position="absolute";
  }
  else
  if(window.screen.width < 751)
     document.getElementById("menu").style.display = "none";
},false);

document.getElementById("publish_trigger").addEventListener('mouseenter',function(event) {
  var x  = event.pageX;
  var y  = event.pageY;
  document.getElementById("explanation").style.visibility = "visible";
  document.getElementById("explanation").style.top = `${y}px`;
  document.getElementById("explanation").style.left = `${x}px`;
},false)

document.getElementById("publish_trigger").addEventListener('mouseout',function(event) {
  document.getElementById("explanation").style.visibility = "hidden";
},false)


