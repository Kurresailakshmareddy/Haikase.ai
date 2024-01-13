var menuBtn = document.getElementById("menuBtn")    
var sideNav = document.getElementById("sideNav")    
var menu = document.getElementById("menu") 

sideNav.style.right = "-250px";

menuBtn.onclick = function(){
    if(sideNav.style.right == "-250px"){
        sideNav.style.right = "0";
        menu.src = "../images/close.png";
    }
    else{
        sideNav.style.right = "-250px";
        menu.src = "../images/menu.png";
    }
}

var scroll = new SmoothScroll('a[href*="#"]', {
	speed: 1000,
	speedAsDuration: true
});



// Toggle the dark theme on button click

const themeToggle = document.getElementById('theme-toggle');
const sunIcon = document.getElementById('sun-icon');
const body = document.body;

themeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-theme');
    if (body.classList.contains('dark-theme')) {
        sunIcon.textContent = '🌙'; // Moon icon for dark theme
    } else {
        sunIcon.textContent = '☀️'; // Sun icon for light theme
    }
});


