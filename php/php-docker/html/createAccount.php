<?php
    include_once('functions.php');
?>    
<?php
    $title = "My page";
    include('header.php');
?>
<main>
    <div>
        <?php echo("Create account"); ?>
    </div>

    <form action="post">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <label for="role">Select Role:</label>
        <select name="role" id="role">
            <option value="customer">Customer</option>
            <option value="subscriber">Subscriber</option>
        </select>
        <input type="submit" name="submit" value="Create Account">
    </form>

</main>
<?php
    include('footer.php');
?>