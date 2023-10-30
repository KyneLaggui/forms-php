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

let barcodeSpans = $("#barcode").children();

function barcodeAnimation()
{
  barcodeSpans.each(function(i)
  {
    let span = $(this);
    setTimeout(function()
    {
      // highlight each individual span with 200ms between each
      span.toggleClass('highlighted');
      // span.fadeToggle("slow");
    }, 200*i);});
  
  barcodeSpans.each(function(i)
  {
    let span = $(this);
    setTimeout(function()
    {
      // remove the highlighting from each span with 20ms between each
      span.toggleClass('highlighted');
      
    }, 20*i);});
}

$(document).ready(function()
{
  setInterval(barcodeAnimation, 4000);
});