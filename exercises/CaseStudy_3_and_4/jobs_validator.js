function chkName(event) {
    
      var myName = event.currentTarget;
      var pos = myName.value.search(/^[A-Za-z ]+$/);
    
      if (pos != 0) {
        alert("The name you entered (" + myName.value + 
              ") is not in the correct form. \n" +
              "Name should contains alphabet characters and character spaces only.");
        myName.focus();
        myName.select();
        return false;
      } 
    }
    
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

function chkDate(event) {

    var startDate = event.currentTarget;
    var now = new Date();
    if (now.getDate()<10) {
        var dateFormatted = "0" + now.getDate()
    }
    else {
        var dateFormatted = now.getDate()
    }
    if ((now.getMonth()+1)<10) {
        var monthFormatted = "0" + (now.getMonth()+1)
    }
    else {
        var monthFormatted = now.getMonth() + 1
    }

    var nowDate = now.getFullYear() + "-" + monthFormatted + "-" + dateFormatted
    // console.log("start" + startDate.value);
    // console.log("now" + nowDate);
    // console.log(startDate.value<=nowDate);

    if (startDate.value <= nowDate) {
        alert("The start date cannot be from today and the past.");
        startDate.focus();
        startDate.select();
        return false;
    } 
}

function chkExp(event) {
    var myExp = event.currentTarget;
    // var myExp = document.forms["jobForm"]["myExp"].value;
    console.log(myExp.value)
    if (myExp.value.length == 0) {
        alert("Experience cannot be empty.");
        myExp.focus();
        myExp.select();
        return false;
    } 
}
    