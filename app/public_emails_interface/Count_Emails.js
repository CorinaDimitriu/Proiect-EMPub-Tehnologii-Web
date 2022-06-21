document.addEventListener("DOMContentLoaded", function(event) {
    let no = countMails();
    createCookie("number_of_mails", no, 365);
    let noCookie = getCookie("number_of_mails");
    if(no.localeCompare(noCookie) != 0) {
      createCookie("number_of_mails", no, 365);
      window.location.reload();
    }
});
   
// Function to create the cookie
function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}

function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    return decodeURI(dc.substring(begin + prefix.length, end));
}

function countMails() {
/*if(window.getComputedStyle(document.getElementById("first-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("second-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("third-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("fourth-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("fifth-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("sixth-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("seventh-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("eigth-email"),"").display != 'none')
   count = count + 1;
if(window.getComputedStyle(document.getElementById("nineth-email"),"").display != 'none')
   count = count + 1;*/
if(window.screen.width >= 1500 && window.screen.height >= 1500)
   return "9";
if(window.screen.width >= 1500)
   return "6";
return "4";
}