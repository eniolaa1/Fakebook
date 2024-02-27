<?php
  include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign Up - FakeBook</title>
</head>
<body class="bg-gray-100 font-serif">
    <div class="flex justify-center py-10 ">
        <form class="bg-white shadow p-10 rounded-2xl h-auto" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "POST">
        <h2 class="text-4xl text-center italic">FakeBook</h2>
        <p class="text-center mt-1 text-lg text-gray-600">Create An Account</p>
        <div class="flex flex-col gap-6 pt-3">
                <div class="">
                    <label for="firstname" class="text-gray-600">First Name:</label><br>
                    <input type="text" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="firstname" id="">
                </div>
                <div class="">
                    <label for="lastname" class="text-gray-600">Last Name:</label><br>
                    <input type="text" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="lastname" id="">
                </div>
                <div class="">
                    <label for="email" class="text-gray-600">Email:</label><br>
                    <input type="email" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="email" id="">
                </div>
                <div class="">
                    <label for="username" class="text-gray-600">Username:</label><br>
                    <input type="text" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="username" id="">
                </div>
                <div>
                    <label for="" class="text-gray-600">Password:</label><br>
                    <input type="password" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="password" id="">
                </div>  
                <div>
                    <label for="" class="text-gray-600">Confirm password:</label><br>
                    <input type="password" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="cpassword" id="">
                    <p class="text-sm text-red-500 hidden" id="password-error">Passwords don't match. Re-type password to confirm</p>
                </div>  
                <input type="submit"class="text-white px-3 py-2 bg-blue-600 rounded focus:outline-none w-96 hover:bg-blue-700" style="cursor: pointer" value="Create Account">
                <p class="text-center">Have an existing account? <a href="index.php" class="text-blue-600 hover:underline">Log In</a></p>
        </div>
        </form>
    </div>
</body>
</html>

<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here or assume that $connection is already established

    // Sanitize and validate user input
    $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];
    $confirmedpassword = $_POST["cpassword"]; 

    // Check if any of the input fields are empty
    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password) || empty($confirmedpassword)) {
        echo "<script>alert(`All fields are required!`)</script>";
    } else {
        // Check if passwords match
        if ($password === $confirmedpassword) {
            // Check if the username already exists
            $check_username_query = "SELECT * FROM users WHERE username = ?";
            $check_username_statement = mysqli_prepare($connection, $check_username_query);
            mysqli_stmt_bind_param($check_username_statement, "s", $username);
            mysqli_stmt_execute($check_username_statement);
            $result = mysqli_stmt_get_result($check_username_statement);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert(`Username already exists! Please choose a different username.`)</script>";
            } else {
                // Hash the password
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

                // Prepare and execute the SQL statement to insert the new user
                $insert_query = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
                $insert_statement = mysqli_prepare($connection, $insert_query);

                if ($insert_statement) {
                    mysqli_stmt_bind_param($insert_statement, "sssss", $firstname, $lastname, $email, $username, $hashedpassword);

                    if (mysqli_stmt_execute($insert_statement)) {
                        // Redirect to home.php upon successful registration
                        header("Location: home.php");
                        exit(); // Ensure script execution stops after the redirect
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }

                    mysqli_stmt_close($insert_statement);
                } else {
                    echo "Error in preparing the statement: " . mysqli_error($connection);
                }
            }

            // Close the database connection
            mysqli_close($connection);
        } else {
            echo "<script>document.getElementById('password-error').classList.remove('hidden');</script>";
        }
    }
}
?>
