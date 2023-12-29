function time() {
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  var d = new Date();
  var day = d.getDate();
  var fullday = days[d.getDay()];
  var month = months[d.getMonth()];
  var year = d.getFullYear();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  document.getElementById("date").innerHTML = fullday + " " + day + " " + month + " " + year + " " + ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
}

setInterval(time, 1000);