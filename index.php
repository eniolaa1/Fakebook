<?php
  include("database.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log In - FakeBook</title>
</head>
<body class="bg-gray-100 font-serif">
    <div class="flex justify-center py-10">
        <form class="bg-white shadow p-10 rounded-2xl" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "POST">
        <h2 class="text-4xl text-center italic">FakeBook</h2>
        <p class="text-center mt-1 text-lg text-gray-600">Log In To Your Account</p>
        <div class="flex flex-col gap-6 pt-3">
                <div class="">
                    <label for="username" class="text-gray-600">Username:</label><br>
                    <input type="text" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="username" id="">
                    <p class="text-sm text-red-500 hidden" id="username-error">Username not found</p>
                </div>
                <div>
                    <label for=""  class="text-gray-600">Password:</label><br>
                    <input type="password" class="px-3 py-2 border-slate-600 border-2 bg-transparent rounded focus:outline-none w-96" name="password" id="">
                    <p class="text-sm text-red-500 hidden" id="password-error">Incorrect password</p>
                </div>  
                <input type="submit" class="text-white p-3 bg-blue-600 rounded focus:outline-none w-96 hover:bg-blue-700" style="cursor: pointer" value="Log In">
                <p class="text-center text-gray-600">Don't have an account? <a href="sign_up.php" class="text-blue-600 hover:underline">Sign up</a></p>
        </div>
        </form>
    </div>
</body>
</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"]; 

    // Check if username and password fields are not empty
    if (empty($username) || empty($password)) {
        echo "<script>alert(`Both username and password are required!`)</script>";
    } else {
        $statement = mysqli_prepare($connection, "SELECT password FROM users WHERE username = ?");
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $hashed_password);

        if (mysqli_stmt_fetch($statement)) {
            // Verify the provided password against the hashed password in the database
            if (password_verify($password, $hashed_password)) {
                // Password is correct; redirect to the home page
                header("Location: home.php");
                exit();
            } else {
                // Password is incorrect; you can display an error message
                echo "<script>document.getElementById('password-error').classList.remove('hidden');</script>";
            }
        } else {
            // Username not found; you can display an error message
            echo "<script>document.getElementById('username-error').classList.remove('hidden');</script>";
        }

        // Close the statement and connection when done
        mysqli_stmt_close($statement);
    }
    mysqli_close($connection);
}
?>
