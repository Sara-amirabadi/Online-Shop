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

setInterval(nextImage, 5000);
