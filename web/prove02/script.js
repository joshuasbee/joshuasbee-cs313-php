function changeColor() {
  var body = document.getElementById("bd");
  var div = document.getElementById("div");//for the entire body
  var a = document.getElementById("linky");//for link to other page
  var r = getRGB();
  var g = getRGB();
  var b = getRGB();
  body.style.backgroundColor = `rgb(${r}, ${g}, ${b})`;
  div.style.color = `rgb(${255 - r}, ${255 - g}, ${255 - b})`;
  a.style.color = `rgb(${255 - r}, ${255 - g}, ${255 - b})`;
}

function getRGB() {
  return Math.random() * 255;
}
