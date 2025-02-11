<?php
include_once('functions.php');
$title = "Login";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mysql = connect_to_database();

    $stmt = $mysql->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password_hash, $role);
        $stmt->fetch();

        if (password_verify($password, $password_hash)) {
            $_SESSION['auth'] = [
                'id' => $id,
                'email' => $email,
                'role' => $role
            ];
            header('Location: index.php');
            exit;
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "No user found with that email.";
    }

    $stmt->close();
    $mysql->close();
}

include('header.php');
?><main>
    <?php 
    if (isset($_GET['message'])) {
        if ($_GET['message'] === 'created') {
            echo "Created account";
        } elseif ($_GET['message'] === 'updated') {
            echo "Password updated";
        } elseif ($_GET['message'] === 'unathorized') {
            echo "You need to login to subscribe";
        }
    }
    ?>
 <div class="form-container">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Login" class="form-button">
        </form>
        <div><p><a href="emailForm.php">Forgot your password?</a></p></div>
    </div>
</main>
<?php
include('footer.php');
?>
