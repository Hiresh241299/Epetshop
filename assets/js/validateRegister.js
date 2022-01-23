//Validate register.php
function validate(fieldName) {
  //get value of input field
  input = document.getElementById(fieldName).value;
  isformvalid = true;

  //fname
  if (fieldName == "fname") {
    //allow onlyy letters
    regex = /^[a-zA-Z]+$/g;

    if (input != "" && input != null) {
      if (regex.test(input)) {
        document.getElementById("fnameErrorMsg").innerHTML = "";
        isformvalid = true;
      } else {
        document.getElementById("fnameErrorMsg").innerHTML =
          "First Name Cannot contain Number!";
        isformvalid = false;
      }
    } else {
      document.getElementById("fnameErrorMsg").innerHTML =
        "First Name Cannot be empty!";
      isformvalid = false;
    }
  }

  //lname
  if (fieldName == "lname") {
    //allow onlyy letters
    regex = /^[a-zA-Z]+$/g;

    if (input != "" && input != null) {
      if (regex.test(input)) {
        document.getElementById("lnameErrorMsg").innerHTML = "";
        isformvalid = true;
      } else {
        document.getElementById("lnameErrorMsg").innerHTML =
          "Last Name Cannot contain Number!";
        isformvalid = false;
      }
    } else {
      document.getElementById("lnameErrorMsg").innerHTML =
        "Last Name Cannot be empty!";
      isformvalid = false;
    }
  }

  //nic
  if (fieldName == "nic") {
    //allow onlyy letters
    regex = /^[A-Z]([0-9]{2})([0-9]{2})([0-9]{4})([0-9]{5})([A-Z]?)$/;

    if (input != "" && input != null) {
      if (regex.test(input)) {
        document.getElementById("nicErrorMsg").innerHTML = "";
        isformvalid = true;
      } else {
        document.getElementById("nicErrorMsg").innerHTML = "NIC not valid!";
        isformvalid = false;
      }
    } else {
      document.getElementById("nicErrorMsg").innerHTML = "NIC Cannot be empty!";
      isformvalid = false;
    }
  }

  //email
  if (fieldName == "email") {
    //allow onlyy letters
    regex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (input != "" && input != null) {
      if (regex.test(input)) {
        document.getElementById("emailErrorMsg").innerHTML = "";
        isformvalid = true;
      } else {
        document.getElementById("emailErrorMsg").innerHTML = "Email not valid!";
        isformvalid = false;
      }
    } else {
      document.getElementById("emailErrorMsg").innerHTML =
        "Email Cannot be empty!";
      isformvalid = false;
    }
  }

  //phone
  if (fieldName == "phone") {
    //allow onlyy letters
    regex = /^[5][0-9]{7}$/;
    if (input != "" && input != null) {
      if (regex.test(input)) {
        document.getElementById("phoneErrorMsg").innerHTML = "";
        isformvalid = true;
      } else {
        document.getElementById("phoneErrorMsg").innerHTML =
          "Mobile number not valid!";
        isformvalid = false;
      }
    } else {
      document.getElementById("phoneErrorMsg").innerHTML =
        "Mobile number Cannot be empty!";
      isformvalid = false;
    }
  }

  //password
  //passwords must contain at least one lowercase, uppercase, number, special Character
  //and mininum eight characters
  if (fieldName == "password") {
    isformvalid = true;
    output = "";

    //length minimum 8
    if (input.length < 8) {
      output += "Password must be at least 8 character </br>";
      isformvalid = false;
    } else {
      isformvalid = true;
    }

    //blank
    if (input == "") {
      output += "Password cannot be blank </br>";
      isformvalid = false;
    } else {
      isformvalid = true;
    }

    //number
    regex = /[0-9]/;
    if (!regex.test(input)) {
      output += "Password must contain at least 1 Number </br>";
      isformvalid = false;
    } else {
      isformvalid = true;
    }
    //special
    regex = /[!@#$%&*()]/;
    if (!regex.test(input)) {
      output += "Password must contain at least 1 Special Character </br>";
      isformvalid = false;
    } else {
      isformvalid = true;
    }
    //lower
    regex = /[a-z]/;
    if (!regex.test(input)) {
      output += "Password must contain at least 1 lower case letter </br>";
      isformvalid = false;
    } else {
      isformvalid = true;
    }
    //upper
    regex = /[A-Z]/;
    if (!regex.test(input)) {
      output += "Password must contain at least 1 Upper Case letter </br>";
      isformvalid = false;
    } else {
      isformvalid = true;
    }
    document.getElementById("passwordErrorMsg").innerHTML = output;
  }

  //confirm password

  //check form valid then enable register button
  if (isformvalid == true) {
    checkpassword();
  }
  //testpassword: Newpassword!1
}

//Validate registerPetshop.php
function validatePetshop(fieldName) {
  //get value of input field
  input = document.getElementById(fieldName).value;
  isformvalid = true;

  //fname
  if (fieldName == "pname") {
    //allow onlyy letters
    regex = /^[a-zA-Z]+$/g;

    if (input != "" && input != null) {
      if (regex.test(input)) {
        document.getElementById("pnameErrorMsg").innerHTML = "";
        isformvalid = true;
      } else {
        document.getElementById("pnameErrorMsg").innerHTML =
          "Business Name Cannot contain Number!";
        isformvalid = false;
      }
    } else {
      document.getElementById("pnameErrorMsg").innerHTML =
        "Business Name Cannot be empty!";
      isformvalid = false;
    }
  }
}
