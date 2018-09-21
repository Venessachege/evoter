$(document).ready(function() {
  $("form.validate").submit(function(event) {
    event.preventDefault();
    
    var password = $("input#Password").val();
      if (password.length < 6) {
      alert("password must be atleast six characters");
      return false;
    } 
    else {
      var email = $("input#Email").val();
      var atposition = email.indexOf("@");
      var dotposition = email.lastIndexOf(".");

      if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email.length) {
        alert("Please enter a valid e-mail address ");
        return false;
      }
    }


  });
});
