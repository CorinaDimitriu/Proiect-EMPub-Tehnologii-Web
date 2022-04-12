function closeMenu() {
    var menu = document.getElementById("menu");
    if (menu.style.display != "none" && smallerMenu.style.display!="none") {
      menu.style.display = "none";
    }
} 

function stopClicking() {
    var button = document.getElementById("smallerMenu");
    if(menu.set.display != "none")
      FocusEvent.stopPropagation();
}