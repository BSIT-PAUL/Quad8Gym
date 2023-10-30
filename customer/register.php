<?php session_start();
include('dbcon.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quad 8 Gym</title>
    <script src="logreg.js"></script>

    <link rel="stylesheet" href="login/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <div class="login-link">
            <div class="logo">
                <img src="img/logoo.png" alt="" height="90%" width="100%">
            </div>
            <p class="side-big-heading">Already a member ?</p>
            <p class="primary-bg-text">To keep track on your dashboard please login with your personal info</p>
            <a href="login.php" class="loginbtn">Login</a>
        </div>
        <form action="#" class="signup-form-container" method="POST">
            <p class="big-heading">Create Account</p>
            <div class="social-media-platform">
                <a href="#"><i class='bx bx-sm bxl-facebook'></i></a>
                <a href="#"><i class='bx bx-sm bxl-twitter'></i></a>
                <a href="#"><i class='bx bx-sm bxl-github'></i></a>
            </div>
            <div class="progress-bar">
                <div class="stage">
                    <p class="tool-tip">Personal info</p>
                    <p class="stageno stageno-1">1</p>
                </div>
                <div class="stage">
                    <p class="tool-tip">Contact info</p>
                    <p class="stageno stageno-2">2</p>
                </div>
                <div class="stage">
                    <p class="tool-tip">Final Submit</p>
                    <p class="stageno stageno-3">3</p>
                </div>
            </div>
            <div class="signup-form-content">
                <div class="stage1-content">
                    <div class="button-container">
                        <div class="text-fields fname required">
                            <label for="fname"><i class='bx bx-user'></i></label>
                            <input type="text" name="fname" required id="fname" placeholder="Enter your first name">
                        </div>
                        <div class="text-fields lname">
                            <label for="lname"><i class='bx bx-user'></i></label>
                            <input type="text" name="lname" required id="lname" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="text-fields username">
                            <label for="username"><i class='bx bxs-user-detail'></i></label>
                            <input type="text" name="username" required id="username" placeholder="Enter your username">
                        </div>
                        <div class="gender-selection">
                            <p class="field-heading" required>Gender : </p>
                            <label for="male">
                                <input type="radio" name="gender" id="male" required>Male
                            </label>
                            <label for="female">
                                <input type="radio" name="gender" id="female" required>Female
                            </label>
                        </div>
                    </div>
                    <div class="pagination-btns">
                        <input type="submit" value="Next" class="nextPage stagebtn1b" onclick="validateForm()" required>
                    </div>
                </div>
                <div class="stage2-content">
                    <div class="button-container">
                        <div class="text-fields phone required">
                            <label for="phone"><i class='bx bx-phone'></i></label>
                            <input type="text" name="phone" required id="phone" placeholder="Phone number">
                        </div>
                        <div class="text-fields email required">
                            <label for="email"><i class='bx bx-envelope'></i></label>
                            <input type="email" name="email" required id="email" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="text-fields password required">
                            <label for="password"><i class='bx bx-lock-alt'></i></label>
                            <input type="password" name="password" required id="password" placeholder="Enter password">
                        </div>
                        <div class="text-fields confirmpassword required">
                            <label for="confirmpassword"><i class='bx bx-lock-alt'></i></label>
                            <input type="password" name="confirmpassword" required id="confirmpassword" placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="pagination-btns">
                        <input type="button" value="Previous" class="previousPage stagebtn2a" onclick="stage2to1()">
                        <input type="button" value="Next" class="nextPage stagebtn1b" onclick="validateStage2()">
                    </div>
                </div>

                <div class="stage3-content">
                    <div class="controls">
                        <div class="main_input_box">
                            <label for="plan">Select a Plan:</label>
                            <select name="plan" required id="plan">
                                <option value="" disabled selected>Select Plans</option>
                                <option value="1">One Month</option>
                                <option value="3">Three Month</option>
                                <option value="6">Six Month</option>
                                <option value="12">One Year</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="controls">
                        <div class="main_input_box">
                            <label for="services">Select a Service:</label>
                            <select name="services" required id="services">
                                <option value="" disabled selected>Select Service</option>
                                <option value="Fitness">Fitness</option>
                                <option value="Sauna">Sauna</option>
                                <option value="Cardio">Cardio</option>
                            </select>
                        </div>
                    </div>

                    <div class="tc-container">
                        <label for="tc" class="tc">
                            <input type="checkbox" name="tc" id="tc" required>
                            By submitting your details, you agree to the <a href="#">terms and conditions.</a>
                        </label>
                    </div>

                    <div class="pagination-btns">
                        <input type="button" value="Previous" class="previousPage stagebtn3a" onclick="stage3to2()">
                        <input type="submit" value="Submit" class="nextPage stagebtn3b">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    let signupConent = document.querySelector(".signup-form-container"),
        stagebtn1b = document.querySelector(".stagebtn1b"),
        stagebtn2a = document.querySelector(".stagebtn2a"),
        stagebtn2b = document.querySelector(".stagebtn2b"),
        stagebtn3a = document.querySelector(".stagebtn3a"),
        stagebtn3b = document.querySelector(".stagebtn3b"),
        signupContent1 = document.querySelector(".stage1-content"),
        signupContent2 = document.querySelector(".stage2-content"),
        signupContent3 = document.querySelector(".stage3-content");


    function validateForm() {
        // Check if the required fields are filled out
        if (document.getElementById("fname").value === "" || document.getElementById("lname").value === "" ||
            document.getElementById("username").value === "" ||
            (document.getElementById("male").checked === false && document.getElementById("female").checked === false)) {
            alert("Please fill out all required fields.");
        } else {
            // If all required fields are filled out, proceed to the next stage
            stage1to2();
        }
    }
    signupContent2.style.display = "none"
    signupContent3.style.display = "none"

    function validateStage2() {
        var phoneValue = document.getElementById("phone").value;
        var emailValue = document.getElementById("email").value;
        var passwordValue = document.getElementById("password").value;
        var confirmPasswordValue = document.getElementById("confirmpassword").value;

        // Check if the required fields are filled out
        if (phoneValue === "" || emailValue === "" || passwordValue === "" || confirmPasswordValue === "") {
            alert("Please fill out all required fields.");
        } else {
            // Check if phone number is exactly 11 digits and contains only numeric digits
            if (!/^\d{11}$/.test(phoneValue)) {
                alert("Phone number must be exactly 11 digits and contain only numeric digits.");
            } else {
                // Check if password and confirm password match
                if (passwordValue !== confirmPasswordValue) {
                    alert("Password and Confirm Password do not match.");
                } else {
                    // If all conditions are met, proceed to the next stage
                    stage2to3();
                }
            }
        }
    }

    function stage1to2() {
        signupContent1.style.display = "none"
        signupContent3.style.display = "none"
        signupContent2.style.display = "block"
        document.querySelector(".stageno-1").innerText = "✔"
        document.querySelector(".stageno-1").style.backgroundColor = "#52ec61"
        document.querySelector(".stageno-1").style.color = "#fff"
    }

    function stage2to1() {
        signupContent1.style.display = "block"
        signupContent3.style.display = "none"
        signupContent2.style.display = "none"
    }

    function stage2to3() {
        signupContent1.style.display = "none"
        signupContent3.style.display = "block"
        signupContent2.style.display = "none"
        document.querySelector(".stageno-2").innerText = "✔"
        document.querySelector(".stageno-2").style.backgroundColor = "#52ec61"
        document.querySelector(".stageno-2").style.color = "#fff"
    }

    function stage3to2() {
        signupContent1.style.display = "none"
        signupContent3.style.display = "none"
        signupContent2.style.display = "block"
    }
</script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</html>