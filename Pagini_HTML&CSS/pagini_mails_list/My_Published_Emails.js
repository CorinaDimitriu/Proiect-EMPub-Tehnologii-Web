document.getElementById("smallerMenu").addEventListener('click', function(event){console.log("hi");
 document.getElementById("menu").style.display="initial";
 document.getElementById("menu").style.position="absolute";},false);

document.getElementById("menu").addEventListener('click', function (event) {
  event.stopPropagation();
});

document.getElementById("menu_closer").addEventListener('click', function (event) {
  document.getElementById("menu").style.display="none";
});


