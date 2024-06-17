<?php
include_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $role = $_POST['role'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli("db", "root", "notSecureChangeMe", "assignment2");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $password_hash, $role);

    if ($stmt->execute()) {
        header('Location: logIn.php?message=created'); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
include('header.php');


?>
<main>
<div class="form-container">
        <h2>Create an account</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="firstName" placeholder="First name" required>
            <input type="text" name="lastName" placeholder="Last name" required>
            <label for="role">Select Role:</label>
            <select name="role" id="role" required>
                <option value="customer">Customer</option>
                <option value="subscriber">Subscriber</option>
            </select>
            <input type="submit" name="submit" value="Create Account" class="form-button">
        </form>
    </div>
</main>
<?php
include('footer.php');
?>
