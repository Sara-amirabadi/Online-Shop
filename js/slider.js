const images = [
    "../image/all-img.png",
    "../image/next.png",
    "../image/pre.png"
];

let index = 0;
let slider = document.getElementById("sliderImage");

slider.style.backgroundImage = `url(${images[index]})`;

function nextImage() {
    index = (index + 1) % images.length;
    slider.style.backgroundImage = `url(${images[index]})`;
}

function prevImage() {
    index = (index - 1 + images.length) % images.length;
    slider.style.backgroundImage = `url(${images[index]})`;
}

document.getElementById("nextBtn").onclick = nextImage;
document.getElementById("prevBtn").onclick = prevImage;


const cartIcon = document.getElementById('cartIcon');
const cartSidebar = document.getElementById('cartSidebar');
cartIcon.addEventListener('click', () => {
    cartSidebar.classList.add('active');
    cartIcon.style.display = 'none';
});
cartSidebar.addEventListener('click', () => {
    cartSidebar.classList.remove('active');
    cartIcon.style.display = 'flex';
});

//shipping
alert("JS LOADED");

const form = document.getElementById("myForm");
const mobileInput = document.getElementById("mobile");

function showError(input, message) {
    const error = input.parentElement.querySelector(".error-text");
    error.innerText = message;
    error.style.display = "block";
}

function hideError(input) {
    const error = input.parentElement.querySelector(".error-text");
    error.style.display = "none";
}

function isValidMobile(value) {
    return /^09\d{9}$/.test(value);
}

form.addEventListener("submit", function (e) {
    e.preventDefault();

    let isValid = true;

    form.querySelectorAll("[required]").forEach(input => {
        if (!input.value.trim()) {
            showError(input, "این فیلد الزامی است");
            isValid = false;
        } else {
            hideError(input);
        }
    });

    if (mobileInput.value.trim() && !isValidMobile(mobileInput.value)) {
        showError(mobileInput, "شماره موبایل معتبر وارد کنید");
        isValid = false;
    }

    if (isValid) {
        console.log("redirecting...");
        alert("OK");
        window.location.href = "../html/login.html";
    }
});
