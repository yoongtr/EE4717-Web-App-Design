// validator2r.js
//   The last part of validator2. Registers the 
//   event handlers
//   Note: This script does not work with IE8

// Get the DOM addresses of the elements and register 
//  the event handlers

var nameNode = document.getElementById("myName");
var emailNode = document.getElementById("myEmail");
var startDateNode = document.getElementById("startDate");
var expNode = document.getElementById("myExp");


nameNode.addEventListener("change", chkName, false);
emailNode.addEventListener("change", chkEmail, false);
startDateNode.addEventListener("change", chkDate, false);
expNode.addEventListener("change", chkExp, false);


