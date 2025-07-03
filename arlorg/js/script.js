
function init(){
	document.getElementById("chevron").onclick = function(){toggleMenu()};
	window.addEventListener("resize", function(){hideMobile()});
}


function toggleMenu() {
	console.log("clicked");
	var svg = document.querySelector('svg');
	var menu = document.getElementById("nav-mobile");
	if (menu.style.display === "none" || menu.style.display === "") {
		menu.style.display = "block";
	} else {
		menu.style.display = "none";
	}
	if (svg.classList.contains("rotate")) {
		svg.classList.remove("rotate");
	} else {
		svg.classList.add("rotate");
	}
}

function hideMobile(){
	var windowWidth = window.innerWidth;
	var menuState = document.getElementById("nav-mobile").style.display;
	
	if(windowWidth > 999 && menuState == "block"){
		document.getElementById("nav-mobile").style.display = "none";
	}
}
window.onload = init;
      



