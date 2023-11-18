<?php 
session_start();
ob_start();
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
        <input type="radio" name="gender" id="male" value="Male" required>Male
    </label>
    <label for="female">
        <input type="radio" name="gender" id="female" value="Female" required>Female
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
                        <div class="text-fields address required">
                            <label for="address"><i class='bx bx-envelope'></i></label>
                            <input type="address" name="address" required id="address" placeholder="Enter your address">
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
                <input type="hidden" name="duration" id="duration" value="1">

                <div class="stage3-content">
                    <div class="controls">
                        <div class="main_input_box">
<label for="plan">Select a Plan:</label>
<select name="plan" required id="plan" onchange="updatePlanDuration()">
    <option value="" disabled selected>Select Plans</option>
    <option value="25|1">25 - DAILY PLAN - Student</option>
    <option value="30|1">30 - DAILY PLAN - Non Student</option>
    <option value="110|7">110 - WEEKLY PLAN- Student</option>
    <option value="130|7">130 - WEEKLY PLAN- Non Student</option>
    <option value="375|30">375 - MONTHLY PLAN - Student</option>
    <option value="430|30">430 - MONTHLY PLAN - Non Student</option>
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
        var addressValue = document.getElementById("address").value;
        var passwordValue = document.getElementById("password").value;
        var confirmPasswordValue = document.getElementById("confirmpassword").value;

        // Check if the required fields are filled out
        if (phoneValue === "" || addressValue === "" || passwordValue === "" || confirmPasswordValue === "") {
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
<script>
    function updatePlanDuration() {
        var planSelect = document.getElementById("plan");
        var durationInput = document.getElementById("duration");

        // Split the selected value into an array [price, duration]
        var selectedPlan = planSelect.value.split("|");

        // Update the duration input field
        durationInput.value = selectedPlan[1];
    }
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $selectedPlan = $_POST['plan'];
$planDetails = explode("|", $selectedPlan);
$amount = $planDetails[0];
$plan = $planDetails[1];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $passwords = $_POST["password"];
    $password = md5($passwords);
    $services = $_POST['services'];

    // Additional data that may need to be collected or set based on your application logic
    $dor = date('Y-m-d'); // Date of registration
    $paid_date = null; // You may set this when payment is made
    $p_year = date('Y'); // Year of registration
    $status = "Active"; // Assuming new members are active by default
    $attendance_count = 0; // Initial attendance count
    $ini_weight = null; // Initial weight (you may retrieve this from the form)
    $curr_weight = null; // Current weight (you may update this as needed)
    $ini_bodytype = ""; // Initial body type (you may retrieve this from the form)
    $curr_bodytype = ""; // Current body type (you may update this as needed)
    $progress_date = null; // Date of progress update
    $reminder = ""; // Any reminders or notes


    $sql = "INSERT INTO members (fullname, username, password, gender, dor, services, amount, paid_date, p_year, plan, address, contact, status, attendance_count, ini_weight, curr_weight, ini_bodytype, curr_bodytype, progress_date, reminder) 
    VALUES ('$fname $lname', '$username', '$password', '$gender', '$dor', '$services', $amount, '$paid_date', '$p_year', '$plan', '$address', '$phone', '$status', $attendance_count, ";
    $sql .= $ini_weight !== null ? $ini_weight : '0'; // Set a default value of 0 if ini_weight is null
    $sql .= ", ";
    $sql .= $curr_weight !== null ? $curr_weight : '0';
    $sql .= ", '$ini_bodytype', '$curr_bodytype', '$progress_date', '$reminder')";
    
    if ($con->query($sql) === TRUE) {
        header('location: login.php');
        echo '<script>alert("New record created successfully");</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    

    // Close the database connection
    $con->close();
}
?>




<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</html>