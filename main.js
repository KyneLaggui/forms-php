const ticketElm = document.getElementById("ticket");
const { x, y, width, height } = ticketElm.getBoundingClientRect();
const centerPoint = {
  x: x + width / 2,
  y: y + height / 2,
};



window.addEventListener("mousemove", (e) => {
    const degreeX = (e.clientY - centerPoint.y) * 0.005;
    const degreeY = (e.clientX - centerPoint.x) * -0.005;

    ticketElm.style.transform = `
        perspective(1000px)
        rotateX(${degreeX}deg)
        rotateY(${degreeY}deg)
    `;
});

const barcodeSpans = document.querySelectorAll("#barcode .animatedSpan");

function barcodeAnimation() {
  barcodeSpans.forEach((span, i) => {
    setTimeout(() => {
      span.classList.add('highlighted');
    }, 200 * i);
    setTimeout(() => {
      span.classList.remove('highlighted');
    }, 20 * i);
  });
}

barcodeAnimation(); 
setInterval(barcodeAnimation, 4000); 

const text = "We are thrilled to have you here! Spacet is your gateway to explore the fascinating intersection vast realm of space.";
const typingSpeed = 60; 
const backspaceSpeed = 10;
const pauseDuration = 3000;
const element = document.getElementById("typing-effect");

let index = 0;
let isBackspacing = false;

function typeText() {
    if (!isBackspacing && index < text.length) {
        element.innerHTML += text.charAt(index);
        index++;
        setTimeout(typeText, typingSpeed);
    } else if (isBackspacing && index > 0) {
        element.innerHTML = text.substring(0, index - 1);
        index--;
        setTimeout(typeText, backspaceSpeed);
    } else {
        isBackspacing = !isBackspacing;
        setTimeout(typeText, pauseDuration);
    }
}

typeText();