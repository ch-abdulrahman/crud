const navbar = document.querySelector(".navbar");
const navItems = document.querySelector(".nav-items");
const nav_li = document.querySelectorAll(".nav-items li");
const menuToggler = document.querySelector(".menu-toggler");
const searchBtn = document.querySelector(".search-btn span");
const searchForm = document.querySelector("#search-form");

const table = document.querySelector(".table");
const tableData = document.querySelectorAll(".data-table tbody td");
const tableContains = document.body.contains(table); //return true or false

const inputForm = document.querySelector(".input-form");
const inputFormContains = document.body.contains(inputForm); //return true or false

// if data overflow the table cell, data will scroll horizontally on scroll
for (const td of tableData) {
    td.addEventListener("wheel", (event) => {
        if (td.clientWidth < td.scrollWidth) {
            event.preventDefault();
            td.scrollBy({
                left: event.deltaY < 0 ? -30 : 30,
            });
        }
    });
}

menuToggler.onclick = () => {
    navbar.classList.toggle("active");
    navItems.classList.toggle("active");
    searchBtn.classList.toggle("hide");
    // if search form is active following actions will perform
    searchBtn.classList.remove("fa-times");
    searchBtn.classList.add("fa-search");
    searchForm.classList.remove("active");
    if (tableContains) table.classList.remove("add-margin");
    if (inputFormContains) inputForm.classList.remove("add-margin");
};

searchBtn.onclick = () => {
    searchForm.classList.toggle("active");
    searchBtn.classList.toggle("fa-search");
    searchBtn.classList.toggle("fa-times");
    if (tableContains) table.classList.toggle("add-margin");
    if (inputFormContains) inputForm.classList.toggle("add-margin");

    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
};

document.onclick = function (e) {
    // hide search form on click outside the search form
    if (!e.target.classList.contains("dont-hide")) {
        searchBtn.classList.add("fa-search");
        searchBtn.classList.remove("fa-times");
        searchForm.classList.remove("active");
        if (tableContains) table.classList.remove("add-margin");
        if (inputFormContains) {
            inputForm.classList.remove("add-margin");
        }
    }
    //add focus class to gender field if target element contains focus-on-click class else remove focus class
    // if (inputFormContains) e.target.classList.contains("focus-on-click") ? genderField.classList.add("focus") : genderField.classList.remove("focus");

};