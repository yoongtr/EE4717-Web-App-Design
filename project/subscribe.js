function chkEmail(event) {
    var myEmail = event.currentTarget;
    var pos = myEmail.value.search(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    if (pos != 0) {
        alert("The email you entered (" + myEmail.value +
                ") is not in the correct form. \n");
        myEmail.focus();
        myEmail.select();
        return false;
    } 
  }
var subscriberNode = document.getElementById("subEmail");
subscriberNode.addEventListener("change", chkEmail, false);