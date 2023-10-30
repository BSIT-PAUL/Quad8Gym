// Function to validate stage 1 inputs
function validateStage1() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    
    if (fname.value.trim() === "" || lname.value.trim() === "") {
        fname.style.border = "2px solid red";
        lname.style.border = "2px solid red";
        return false; // Prevent progression to the next stage
    } else {
        fname.style.border = "1px solid #ccc"; // Reset border
        lname.style.border = "1px solid #ccc"; // Reset border
    }
    
    return true;
}

// Function to validate stage 2 inputs
function validateStage2() {
    const phone = document.getElementById("phone");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmpassword");
    
    if (phone.value.trim() === "" || email.value.trim() === "" || password.value.trim() === "" || confirmPassword.value.trim() === "") {
        phone.style.border = "2px solid red";
        email.style.border = "2px solid red";
        password.style.border = "2px solid red";
        confirmPassword.style.border = "2px solid red";
        return false; // Prevent progression to the next stage
    } else {
        phone.style.border = "1px solid #ccc"; // Reset border
        email.style.border = "1px solid #ccc"; // Reset border
        password.style.border = "1px solid #ccc"; // Reset border
        confirmPassword.style.border = "1px solid #ccc"; // Reset border
    }
    
    if (password.value !== confirmPassword.value) {
        confirmPassword.style.border = "2px solid red";
        return false; // Prevent progression to the next stage
    } else {
        confirmPassword.style.border = "1px solid #ccc"; // Reset border
    }
    
    return true;
}

// Function to validate stage 3 inputs
function validateStage3() {
    const tcCheckbox = document.getElementById("tc");
    
    if (!tcCheckbox.checked) {
        tcCheckbox.style.outline = "2px solid red"; // Add red outline
        return false; // Prevent form submission
    } else {
        tcCheckbox.style.outline = "none"; // Reset outline
    }
    
    return true;
}
