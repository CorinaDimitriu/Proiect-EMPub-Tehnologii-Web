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


