function validateForm() {
  const email = document.forms["feedbackForm"]["email"].value;
  if (email === "") {
    alert("Email is required");
    return false;
  }
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert("Invalid email format");
    return false;
  }
  // Add more validation for checkboxes, radio buttons, etc.
  return true;
}
