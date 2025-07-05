const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const navok = document.querySelector(".navok");
const main = document.querySelector("main")

hamburger.addEventListener("click", ()=> {

    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    navok.classList.toggle("active");
    main.classList.toggle("active");

})

document.querySelector(".nav-link").forEach(n => n.addEventListener("click", () => {

    hamburger.classList.remove("active")
    navMenu.classList.remove("active")
    navok.classList.remove("active");
    main.classList.remove("active");

}))
function showDropdown() {
    document.getElementById("dropdownMenu").style.display = "block";
}

function hideDropdown() {
    document.getElementById("dropdownMenu").style.display = "none";
}