//@@@@@@@@@@@@@@ Varaibles @@@@@@@@@@@@@@@
const form = document.querySelector(".input-form.validate");
const fields = document.querySelectorAll(".field");
const inputs = document.querySelectorAll(".field input");

const id = document.querySelector("#id");
const fnameField = document.querySelector(".fname");
const fnameInput = document.querySelector("#fname");
const lnameField = document.querySelector(".lname");
const lnameInput = document.querySelector("#lname");
const fatherField = document.querySelector(".fathername");
const fatherInput = document.querySelector("#fathername");
const emailField = document.querySelector(".email");
const emailInput = document.querySelector("#email");
const phoneField = document.querySelector(".phone");
const phoneInput = document.querySelector("#phone");
const addressField = document.querySelector(".address");
const addressInput = document.querySelector("#address");
const postalField = document.querySelector(".postal");
const postalInput = document.querySelector("#postal");
const cityField = document.querySelector(".city");
const cityInput = document.querySelector("#city");
const genderField = document.querySelector(".gender");
const genderRadios = document.querySelectorAll(".gender-radio");
const depField = document.querySelector(".department");
const depSelect = document.querySelector("#department");
const dobField = document.querySelector(".dob");
const dobInput = document.querySelector("#dob");

fatherInput.value = "M Maqbool";
dobInput.value = "2003-12-20";
addressInput.value = "Post Office Chowk Sarwar Sheed, Chak No. 563 TDA, Tehsil Kot Addu, District Muzaffargarh";
//@@@@@@@@ Adding Focus Events @@@@@@@@

for (const input of inputs) { //loop to add events to all inputs
  input.onfocus = () => input.parentElement.parentElement.classList.add("focus");
  input.onblur = () => input.parentElement.parentElement.classList.remove("focus");
  //if user focus in input field then focus class will be added to grand parent
  //if user focus in another input field then focus class will be removed
}
//add focus and blur event to select department
depSelect.onblur = () => depField.classList.remove("focus");
depSelect.onfocus = () => depField.classList.add("focus");
//add focus class to gender field if target element contains focus-on-click class else remove focus class
document.onclick = (e) => e.target.classList.contains("focus-on-click") ? genderField.classList.add("focus") : genderField.classList.remove("focus");

postalInput.onkeydown = event => /[^e\.]/i.test(event.key);

//@@@@@@@ Form Validation on Submit @@@@@@@@

form.onsubmit = function (e) {
  // e.preventDefault(); //preventing from form submitting 
  checkFirstName();
  checkLastName();
  checkFatherName();
  checkGender();
  checkDOB();
  checkDepartment();
  checkAddress();
  checkPostalCode();
  checkCity();
  checkPhone();
  checkEmail();

  //calling functions on input event
  fnameInput.oninput = checkFirstName;
  lnameInput.oninput = checkLastName;
  fatherInput.oninput = checkFatherName;
  genderField.onclick = checkGender;
  dobInput.onchange = checkDOB;
  depSelect.onchange = checkDepartment;
  emailInput.oninput = checkEmail;
  phoneInput.oninput = checkPhone;
  addressInput.oninput = checkAddress;
  postalInput.oninput = checkPostalCode;
  cityInput.oninput = checkCity;

  for (const field of fields) {
    //when user submit form if any input field contains error class
    //then shake class will be added to it and form will not be submited
    if (field.classList.contains("error")) {
      addShakeClass(field); //add shake class to field
      e.preventDefault(); //preventing from form submitting 
    }
  }


  // setTimeout(() => {
  //   if (noFieldContainsError(fields)) {
  //     submitForm(this);
  //   } else {
  //     console.log("Input contains Errors");
  //   }
  // }, 500)



};

function submitForm(form) {
  const formData = new FormData(form);
  formData.append(form.querySelector(".form-btn").name, true); //append value of name attribute as form key

  fetch('submit.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(result => {
      console.log(result);
      //  if (result) {
      //     console.log("Your form is submitted")
      //  } else {
      //     console.log("Your form is not submitted")
      //  }
    }).catch(error => console.log(error))


  // const response = await fetch('save.php', {
  //   method: 'POST',
  //   body: formData
  // });
  // const result = await response.text();
  // if (result) {
  //   console.log("Your form is submitted")
  // } else {
  //   console.log("Your form is not submitted")
  // }
}

function checkEmail() { //function to check Email Address
  let value = emailInput.value.trim(); //trim white spaces from left and right
  let errorText = emailField.querySelector(".error-txt");
  let pattern = /^[a-z0-9]([_\.-]?[a-z0-9])*@[a-z0-9]+([\.-]?[a-z0-9]+)*(\.[a-z0-9]{2,})+$/gi; //pattern to validate email address which contains only (a-z) (A-Z) (0-9) (.) (-) and (_) underscore is just for username and hypen (-) can be added in the domain name
  if (value.includes("@gmail.com")) pattern = /^[a-z0-9](\.?[a-z0-9]){5,29}@gmail\.com$/gi; //if email input contains @gmail.com then then this pattern will follow which contains only (a-z) (A-Z) (0-9) and (.)

  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    //check email in database if it is already exists

    // const formData = new FormData();
    // formData.append('id', id.value);
    // formData.append('email', value);
    // formData.append('checkemail', true);
    // fetch('submit.php', {
    //     method: 'POST',
    //     body: formData
    //   })
    //   .then(response => response.text())
    //   .then(result => {
    //     console.log("Email " + result);
    //     console.log("Email Type " + typeof (result));
    //     console.log((result) ? "ok" : "cancel");
    // if (result === "true") {
    //   addShakeClass(emailField);
    //   addError_RemoveValid(emailField);
    //   errorText.innerText = "Sorry! this email already exists";
    //   console.log("Error");
    // } else {
    //   addValid_RemoveError(emailField);
    //   console.log("Valid");
    // }
    // }).catch(error => console.log(error));


    let http = new XMLHttpRequest();
    http.open('POST', 'submit.php');
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-')
    http.send(`id=${id.value}&email=${value}&checkemail=true`) //send these values to submit.php
    http.onload = function () { //when server load the data fully
      console.log("Email " + this.responseText);
      console.log("Email Type " + typeof (this.responseText));
      console.log((this.responseText) ? "ok" : "cancel");
      if (this.responseText) { //if responseText is true means email is exists in database
        addShakeClass(emailField);
        addError_RemoveValid(emailField);
        errorText.innerText = "Sorry! this email already exists";
      } else {
        addValid_RemoveError(emailField);
      }
    }

  } else { //if pattern not matched then add error and remove valid class
    addError_RemoveValid(emailField);
    if (value == "") { //if email is blank then add shake class to email filed
      addShakeClass(emailField);
      errorText.innerText = "email can't be blank";
    } else if (value.includes(" ")) { //if email contains white space 
      errorText.innerText = "email can't contain white space";
    } else if (pattern.toString().includes("@gmail")) { //if pattern contains @gmail
      if (value.match(/[!#$%^&*()_+={}\[\]|:;"'<>?,`~/-]/gi)) { //if gmail contain any character except .
        errorText.innerText = "only (a-z 0-9 . ) are allowed for gmail";
      } else if (value.replace("@gmail.com", "").length < 6 || value.replace("@gmail.com", "").length > 30) { //if gmail username is less than 6 or greater than 30
        errorText.innerText = "gamil username must contain 6-30 characters";
      } else { //if gmail is invalid
        errorText.innerText = "Enter a valid gmail address";
      }
    } else { //if email is invalid
      errorText.innerText = "Enter a valid email address";
    }
  }
}

function checkPhone() { //function to check Phone Number
  //check phone number in database if it is already exists
  let value = phoneInput.value.trim(); //trim white spaces from left and right
  let errorText = phoneField.querySelector(".error-txt");
  let pattern = /^((\s*?)(\+92-?|92-?|0))3[0-4][0-9]-?\d{7}(\s*?)$/; //pattern to check phone number
  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    let http = new XMLHttpRequest();
    http.open('POST', 'submit.php');
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-')
    http.send(`id=${id.value}&phone=${value}&checkphone=true`) //send these values to submit.php
    http.onload = function () { //when server load the data fully
      console.log("Phone: " + this.responseText);
      if (this.responseText) { //if responseText is true means phone number is exists in database
        addShakeClass(phoneField);
        addError_RemoveValid(phoneField);
        errorText.innerText = "Sorry! this number already exists"
      } else {
        addValid_RemoveError(phoneField);
      }
    }
  } else { //if pattren not matched then add error class and remove valid class
    addError_RemoveValid(phoneField);
    if (value == "") { //remove error class on blank becuase phone number is optional
      phoneField.classList.remove("error");
    } else { //if phone  number is invalid
      errorText.innerText = "invalid phone number";
    }
  }
}

//@@@@@@ All Functions Declaration and Definiton @@@@@@@

function checkFirstName() { //function to check First Name
  let value = fnameInput.value.trim(); //trim white spaces from left and right
  let errorText = fnameField.querySelector(".error-txt");
  let pattern = /^((\s*?)[a-z])([-']?[a-z\s]){1,19}(\s*?)$/gi; //pattern to check first name
  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    addValid_RemoveError(fnameField);
  } else { //if pattren not matched then add error class and remove valid class
    addError_RemoveValid(fnameField);
    if (value == "") { //if first name is blank then add shake class to first name filed
      addShakeClass(fnameField);
      errorText.innerText = "first name can't be blank";
    } else if (value.match(/^[^a-z]/i)) { //if first name does not start from alphabets a-z
      errorText.innerText = "first name must start from alphabets";
    } else if (value.match(/[^a-z\s-']/i)) { //if first name contains any other characters except [a-z\s-']
      errorText.innerText = "only (-) and (') are allowed";
    } else if (value.length < 2 || value.length > 20) { //if first name characters are less than 2 or greater than 20
      errorText.innerText = "first name must contain 2-20 characters";
    } else { // if first name is incorrect
      errorText.innerText = "enter correct name";
    }
  }
}

function checkLastName() { //function to check Last Name
  let value = lnameInput.value.trim(); //trim white spaces from left and right
  let errorText = lnameField.querySelector(".error-txt");
  let pattern = /^((\s*?)[a-z])([-']?[a-z\s]){1,19}(\s*?)$/gi; //pattern to check last name
  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    addValid_RemoveError(lnameField);
  } else { //if pattren not matched then add error class and remove valid class
    addError_RemoveValid(lnameField);
    if (value == "") { //if last name is blank then add shake class to last name filed
      addShakeClass(lnameField);
      errorText.innerText = "last name can't be blank";
    } else if (value.match(/^[^a-z]/i)) { //if last name does not start from alphabets a-z
      errorText.innerText = "last name must start from alphabets";
    } else if (value.match(/[^a-z\s-']/i)) { //if last name contains any other characters except [a-z\s-']
      errorText.innerText = "only (-) and (') are allowed";
    } else if (value.length < 2 || value.length > 20) { //if last name characters are less than 2 or greater than 20
      errorText.innerText = "last name must contain 2-20 characters";
    } else { // if last name is incorrect
      errorText.innerText = "enter correct name";
    }
  }
}

function checkFatherName() { //function to check Father Name
  let value = fatherInput.value.trim(); //trim white spaces from left and right
  let errorText = fatherField.querySelector(".error-txt");
  let pattern = /^((\s*?)[a-z])([-']?[a-z\s]){2,39}(\s*?)$/gi; //pattern to check father name
  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    addValid_RemoveError(fatherField);
  } else { //if pattren not matched then add error class and remove valid class
    addError_RemoveValid(fatherField);
    if (value == "") { //if father name is blank then add shake class to father name filed
      addShakeClass(fatherField);
      errorText.innerText = "father name can't be blank";
    } else if (value.match(/^[^a-z]/i)) { //if father name does not start from alphabets a-z
      errorText.innerText = "father name must start from alphabets";
    } else if (value.match(/[^a-z\s-']/i)) { //if father name contains any other characters except [a-z\s-']
      errorText.innerText = "only (-) and (') are allowed";
    } else if (value.trim().length < 3 || value.trim().length > 40) { //if father name characters are less than 3 or greater than 40
      errorText.innerText = "father name must contain 3-40 characters";
    } else { //if father name is incorrect
      errorText.innerText = "enter correct name";
    }
  }
}

function checkGender() { //function to check Gender
  if (anyOptionIsChecked(genderRadios)) { //if any radio is checked then add valid class and remove error class
    addValid_RemoveError(genderField);
  } else { //if no radio is checked then add error class and remove valid class
    addError_RemoveValid(genderField);
    genderField.querySelector(".error-txt").innerHTML = "please select your gender";
  }

  function anyOptionIsChecked(radios) { //function to check either option is checked
    for (const radio of radios) {
      if (radio.checked == true) return true; //if any radio is checked then return and loop terminated
    }
    return false; //if no radio is checked then return false
  }
}

function checkDOB() { //function to date of birth
  let age = calculateAge(dobInput.value); //calling function to calculate age
  if (age >= 18 && age <= 45) { //if age is >= 18 and <= 45 then remove error and add valid class
    addValid_RemoveError(dobField);
  } else { //if age is invalid then add error and remove valid class
    addError_RemoveValid(dobField);
    errorText = dobField.querySelector(".error-txt");
    if (age < 18) { //if age is less than 18
      errorText.innerHTML = "your age must be >= 18";
    } else if (age > 45) { //if age is greater than 45
      errorText.innerHTML = "your age must be <= 45";
    } else { //if date of birth is not selected
      errorText.innerHTML = "please enter your date of birth";
    }
  }

  function calculateAge(date) { //function to calculte age
    let today = new Date();
    let birthDate = new Date(date);
    let age = today.getFullYear() - birthDate.getFullYear();
    let month = today.getMonth() - birthDate.getMonth();
    if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) age--;
    return age;
  }
}

function checkDepartment() { //function to check Department
  if (depSelect.value != "") { //if department contains null value then
    addValid_RemoveError(depField);
  } else { //if no deparment is selected then add error class and remove valid
    addError_RemoveValid(depField);
    depField.querySelector(".error-txt").innerHTML = "please select your department";
  }
}

function checkAddress() { //function to check Address
  let value = addressInput.value.trim(); //trim white spaces from left and right
  let errorText = addressField.querySelector(".error-txt");
  let pattern = /^(\s*?).{10,150}(\s*?)$/; //pattern to check address
  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    addValid_RemoveError(addressField);
  } else { //if pattren not matched then add error class and remove valid class
    addError_RemoveValid(addressField);
    if (value == "") { //if address is blank then add shake class to address filed
      addShakeClass(addressField);
      errorText.innerText = "address can't be blank";
    } else { //if address characters length is less than 10 or greater than 150
      errorText.innerText = "address must be 10-150 characters";
    }
  }
}

function checkPostalCode() { //function to check Postal Code
  let value = postalInput.value;
  let errorText = postalField.querySelector(".error-txt");
  let pattern = /^((\s*?)[1-9])\d{4}(\s*?)$/; //pattern to check postal code
  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    addValid_RemoveError(postalField);
  } else { //if pattren not matched then add error class and remove valid class
    addError_RemoveValid(postalField);
    if (value == "") { //remove error class on blank becuase postal code is optional
      postalField.classList.remove("error");
    } else if (value.startsWith("0")) { //if postal code starts from 0
      errorText.innerText = "postal code can't start from 0";
    } else { //postal code is invalid
      errorText.innerText = "enter 5-digit postal code";
    }
  }
}

function checkCity() { //function to check City
  let value = cityInput.value.trim(); //trim white spaces from left and right
  let errorText = cityField.querySelector(".error-txt");
  let pattern = /^((\s*?)[a-z])([-']?[a-z0-9\s]){3,49}(\s*?)$/gi; //pattern to check city name
  if (value.match(pattern)) { //if pattern matched then add valid and remove error class
    addValid_RemoveError(cityField);
  } else { //if pattren not matched then add error class and remove valid class
    addError_RemoveValid(cityField);
    if (value == "") { //if city is blank then add shake class to city filed
      addShakeClass(cityField);
      errorText.innerText = "city can't be blank";
    } else if (value.match(/^[^a-z]/i)) { //if city name does not start from alphabets a-z
      errorText.innerText = "city name must start from alphabets";
    } else if (value.match(/[^a-z0-9\s-']/i)) { //if city name contains any other characters except [a-z0-9\s-']
      errorText.innerText = "only (-) and (') are allowed";
    } else if (value.length < 4 || value.length > 30) { //if city characters length is less than 5 or greater than 50
      errorText.innerText = "city must contain 4-50 characters";
    } else { //if city is invalid
      errorText.innerText = "enter correct city name";
    }
  }
}

function addError_RemoveValid(field) {
  field.classList.add("error");
  field.classList.remove("valid");
}

function addValid_RemoveError(field) {
  field.classList.add("valid");
  field.classList.remove("error");
}

function addShakeClass(field) {
  field.classList.add("shake");
  setTimeout(() => field.classList.remove("shake"), 500); //setTimeout function remove shake class from given element after 500ms
}

function noFieldContainsError(fields) {
  for (const field of fields) {
    if (field.classList.contains("error")) return false;
  }
  return true;
}

//Regular Expression
//\d means (0-9)
//\w means (A-Z a-z 0-9 _ )
//\s means (white space)
//. means any character
//(\s*?) means (multiple spaces are optional)