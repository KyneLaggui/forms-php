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