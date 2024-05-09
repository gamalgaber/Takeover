
const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
const x = document.querySelectorAll(".sidebaar li a");

x.forEach(a => {
    a.addEventListener('click', () => {
        reset();
        a.classList.add('active');
    })
})

function reset() {
    x.forEach(a => {
        a.classList.remove('active');
    })
}
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("view_btn").addEventListener("click", function() {
        document.getElementById("div_1").classList.add("d-none");
        document.getElementById("div_2").classList.remove("d-none");
    });
  
    document.getElementById("close_icon").addEventListener("click", function() {
        document.getElementById("div_2").classList.add("d-none");
        document.getElementById("div_1").classList.remove("d-none");
    });
});
