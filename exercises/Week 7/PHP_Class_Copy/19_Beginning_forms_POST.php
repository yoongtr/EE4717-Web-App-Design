<html>
<body>

<form action="testerpage.php" method = "post"> 

Name: <input type = "text"  name = "name"><br> 

E-mail: <input type="text" name="email"><br>

<input type = "submit" >
</form>
</body>
</html>

<?php 

/* Method = "post" An HTML form is submitted using this method. 

* When to use GET?
Information sent from a form with the GET method is visible to everyone (all variable names and values are displayed in the URL). GET also has limits on the amount of information to send. The limitation is about 2000 characters. However, because the variables are displayed in the URL, it is possible to bookmark the page. This can be useful in some cases.
GET may be used for sending non-sensitive data.
Note: GET should NEVER be used for sending passwords or other sensitive information!



When to use POST?
Information sent from a form with the POST method is invisible to others (all names/values are embedded within the body of the HTTP request) and has no limits on the amount of information to send.

Moreover POST supports advanced functionality such as support for multi-part binary input while uploading files to server.

However, because the variables are not displayed in the URL, it is not possible to bookmark the page.*/





?>