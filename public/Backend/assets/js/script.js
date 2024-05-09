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
// ****************************************************************************

// document.addEventListener("DOMContentLoaded", function() {
//     document.getElementById("view_btn").addEventListener("click", function() {
//         document.getElementById("div_1").classList.add("d-none");
//         document.getElementById("div_2").classList.remove("d-none");
//     });
//     document.getElementById("close_iconn").addEventListener("click", function() {
//         document.getElementById("div_2").classList.add("d-none");
//         document.getElementById("div_1").classList.remove("d-none");
//     });
// });

// ************************************************* dataTable*************************************

//*==========ISOTOPE==============
var $grid = $('.grid').isotope({});

$('.monthly_top_filter').on('click', 'button', function () {
    var filterValue = $(this).attr('data-filter');
    $grid.isotope({
        filter: filterValue
    });
});

//active class
$('.monthly_top_filter button').on("click", function (event) {

    $(this).siblings('.active').removeClass('active');
    $(this).addClass('active');
    event.preventDefault();

});
