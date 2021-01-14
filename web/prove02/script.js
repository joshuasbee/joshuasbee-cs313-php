function changeColor() {
  var body = document.getElementById("bd");
  var header = document.getElementById("div");
  var r = getRGB();
  var g = getRGB();
  var b = getRGB();
  body.style.backgroundColor = `rgb(${r}, ${g}, ${b})`;
  header.style.color = `rgb(${255 - r}, ${255 - g}, ${255 - b})`;
}

function getRGB() {
  return Math.random() * 255;
}
