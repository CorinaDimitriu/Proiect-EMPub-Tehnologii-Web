function verifyData() {
  var published = document.getElementById("published");
  var privacy = document.getElementById("privacy");
  var password = document.getElementById("password");
  var duration = document.getElementById("duration");

  var message = "";
  if (published.value !== "Yes" && published.value !== "No")
    message = message.concat("Published must be 'Yes' or 'No'. ");
  if (privacy.value !== "Private" && privacy.value !== "Public")
    message = message.concat("Privacy must be 'Public' or 'Private'. ");

  var upperCaseLetters = /[A-Z]/g;
  var numbers = /[0-9]/g;
  var specialCharacters = /[^A-Za-z 0-9]/g;

  if (privacy.value === "Private" && password.value === "none")
    message = message.concat(
      "Password cannot be 'none' because Privacy is set to 'Private'. "
    );
  if (password.value !== "none") {
    if (password.value.length < 4)
      message = message.concat("Password must be at leat 4 characters long. ");
    if (!upperCaseLetters.test(password.value))
      message = message.concat(
        "Password must contain at least one uppercase letter. "
      );
    if (!numbers.test(password.value))
      message = message.concat("Password must contain at least one number. ");
    if (!specialCharacters.test(password.value))
      message = message.concat(
        "Password must contain at least one special character. "
      );
  }

  var dateFormat =
    /^\d{4}-(0[1-9]|1[0-2])-([0-2]\d|3[01]) ([0-1]\d|2[0123]):[0-5]\d:[0-5]\d$/;
  if (!dateFormat.test(duration.value))
    message = message.concat("Date format must be yyyy-mm-dd hh:mi:ss.");

  if (message !== "") {
    alert(message);
    return false;
  }
  return true;
}
