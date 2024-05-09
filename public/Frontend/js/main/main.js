let showmore_button = document.querySelector('.button__card__showmore ');
let currentItem = 4;

showmore_button.onclick = () => {
    let cards = [...document.querySelectorAll('.product__full-card ')];
    for (let i = currentItem; i < currentItem + 4; i++) {
        cards[i].style.display = 'inline-block';

    }
    currentItem += 4;
    if (currentItem >= cards.length) {
        showmore_button.style.display = 'none';
    }
}






// Add event listeners to each quick add button
let quickAddButtons = document.querySelectorAll('.card__button--size');
let showButtons = document.querySelectorAll('.card__product--size');

quickAddButtons.forEach((quickAddBtn, index) => {
    quickAddBtn.addEventListener('click', function() {
        showButtons[index].style.display = 'block';
        quickAddBtn.innerHTML = "ADD";
    });
});

// Add event listeners to each close button
let closeButtons = document.querySelectorAll('.btn__close');

closeButtons.forEach((closeBtn, index) => {
    closeBtn.addEventListener('click', function() {
        showButtons[index].style.display = 'none';
        quickAddButtons[index].innerHTML = "QUICK ADD";
    });
});




let sizes = document.querySelectorAll('.product--size');
let spans = document.querySelectorAll('.product__spans--size span');

spans.forEach(span => {
    span.addEventListener('click', function() {
        spans.forEach(otherSpan => {
            otherSpan.classList.remove("card__product--typeof-size");
        });

        this.classList.add("card__product--typeof-size");

        sizes.forEach(size => {
            size.textContent = this.textContent;
        });
    });
});



let filterLinks = document.querySelectorAll(".product--filter");

filterLinks.forEach(link => {
    link.addEventListener("click", () => {
        document.querySelector(".active").classList.remove('active');
        link.classList.add('active');
    })
})


const toggleHeader = document.querySelector('.toggle-header');
const toggleContent = document.querySelector('.toggle-content');


toggleHeader.addEventListener('click', function() {
    toggleContent.classList.toggle('show');
});



// filter section
const filterButtons = document.querySelectorAll("#filter-buttons button");
const filterableCards = document.querySelectorAll("#filterable-cards .cardd");

// Function to filter cards based on filter buttons
const filterCards = (e) => {
    document.querySelector("#filter-buttons .active").classList.remove("active");
    e.target.classList.add("active");

    filterableCards.forEach(card => {
        if (card.dataset.name === e.target.dataset.filter) {
            card.classList.remove("hide");
            card.classList.add("showw");
        } else {
            card.classList.remove("showw");
            card.classList.add("hide");
        }
    });
}

filterButtons.forEach(button => button.addEventListener("click", filterCards));
filterButtons[0].click();
