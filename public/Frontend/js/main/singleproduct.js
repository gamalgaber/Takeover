let mainimg = document.querySelector("#singleproduct__MainImg");
let smallimg = document.querySelectorAll(".singleproduct__smallImg");

smallimg.forEach((img) => {
    img.addEventListener("click", function () {
        mainimg.src = img.src;
    });
});

// let price = document.querySelector(".price__product");
// let act__price = document.querySelector(".act__price");

// price.textContent = act__price.textContent;

function increaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
}

function decreaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

let sizee = document.querySelector(".main--size");
let spanss = document.querySelectorAll(".size--text span");

spanss.forEach((el) => {
    el.addEventListener("click", function () {
        spanss.forEach((el) => {
            el.classList.remove("activeeee");
        });
        this.classList.add("activeeee");
        sizee.textContent = this.textContent;
    });
});
