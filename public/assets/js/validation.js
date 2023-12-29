var validity = true;


function validateUsername(){
  var username = document.getElementById("username");

  try{
    if(isNaN(username.value) === true || username.value === ""){
      throw " ";
      validity = false;
    }
    username.style.background = "green";
  }catch{
    username.style.background = "rgb(255,233,233)";
  }
}

function validatePassword(){
  let password = document.getElementById("password");

  try{
    if(password.value === ""){
      throw " ";
      validity = false;
    }
    password.style.background = "green";
  }catch{
    password.style.background = "rgb(255,233,233)";
  }
}

function validateModuleCode(){
  let v = document.getElementById("modulecode");

  try{
    if(v.innerHTML === ""){
      throw " ";
      validity = false;
    }
    v.style.background = "green";
  }catch{
    v.style.background = "rgb(255,233,233)";
  }
}

function preventFormSubmition(evt){
  /*if (evt.preventDefault) {
    evt.preventDefault();
  }else{
    evt.returnValue = false;
  }*/
  //validity = true;
  validateUsername();
  validatePassword();
  function validateModuleCode(){
  let password = document.getElementById("modulecode");

  try{
    if(password.value === ""){
      throw " ";
      validity = false;
    }
    password.style.background = "green";
  }catch{
    password.style.background = "rgb(255,233,233)";
  }
}
}

function createEventListeners(){
  var username = document.getElementById("username");
  var password = document.getElementById("password");

  var form = document.getElementsByTagName("form")[0];
  //var form = document.getElementById("submit");
  if (form.addEventListener) {
    form.addEventListener("click", preventFormSubmition, false);
  }else if(form.attachEvent){
    form.attachEvent("onclick", preventFormSubmition);
  }


  if (username.addEventListener) {
    username.addEventListener("change", validateUsername, false);
  }else if(name.attachEvent){
    username.attachEvent("onchange", validateUsername);
  }

  if (password.addEventListener) {
    password.addEventListener("change", validatePassword , false);
  }else if(name.attachEvent){
    password.attachEvent("onchange", validatePassword);
  }
}

function aaaaa(){
  createEventListeners();
}

if (window.addEventListener) {
  window.addEventListener("load", aaaaa, false);
}else{
  window.attachEvent("onload", aaaaa);
}