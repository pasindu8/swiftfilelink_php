var settingsEl = document.getElementById("Settings");
var headEl = document.getElementById("head");
var menuEl = document.getElementById("menu");

if(settingsEl) settingsEl.style.display = "none";
if(headEl) headEl.style.display = "block";
if(menuEl) menuEl.style.display = "inline-block";

function hide() {
    if(settingsEl) settingsEl.style.display = "none";
    if(headEl) headEl.style.display = "block";
    if(menuEl) menuEl.style.display = "inline-block";
}

function show() {
    if(menuEl) menuEl.style.display = "none";
    if(headEl) headEl.style.display = "none";
    if(settingsEl) settingsEl.style.display = "block";
}