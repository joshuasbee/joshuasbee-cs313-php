function clicked() {
  alert("Clicked!");
}

function color_change() {
  var color = document.getElementById("color_text").value;
  var div1 = document.getElementById("div1");
//document.getElementById("myDiv").style.backgroundColor = "lightblue"; 
  div1.style.backgroundColor = color;
}