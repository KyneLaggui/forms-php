const ticketElm = document.getElementById("ticket");
const { x, y, width, height } = ticketElm.getBoundingClientRect();
const centerPoint = {
  x: x + width / 2,
  y: y + height / 2,
};



window.addEventListener("mousemove", (e) => {
    const degreeX = (e.clientY - centerPoint.y) * 0.008;
    const degreeY = (e.clientX - centerPoint.x) * -0.008;

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

barcodeAnimation(); // Initial animation
setInterval(barcodeAnimation, 4000); // Repeating animation