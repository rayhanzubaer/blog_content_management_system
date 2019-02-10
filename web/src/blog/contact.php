<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/header.php';
?>
<!-- #end navigation -->
    <div id="page" class="overflow">
        <div id="content" class="overflow">
            <h1>Contact Us</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);

    $validate = new Validate();
    $validation = $validate->check(array($name, $email,$subject, $message));

    if ($validation->pass()) {
        $sql = "INSERT INTO contact(name, email, subject, message) VALUES('$name', '$email', '$subject', '$message');";
        $result = DB::getInstance()->insert($sql);
  
        if ($result) {
            echo "<p class='success'>Message sent succussfully.</p>";
        }
        else {
            echo "<p class='error'>Message could not be sent.</p>";
        }
    }
    else {
        echo "<p class='error'>Message could not be sent.</p>";
    }
}
?>
            <form method="POST" action="">
                <table>
                    <tr>
                        <td ><label for="name">Name : </label></td>
                        <td><input type="text" name="name" placeholder="type your name"/></td>
                    </tr>
                    <tr>
                        <td><label for="email">E-mail : </label></td>
                        <td><input type="text" name="email" placeholder="type your email address"/></td>
                    </tr>
                    <tr>
                        <td><label for="subject">Subject : </label></td>
                        <td><input type="text" name="subject" placeholder="type email subject"/></td>
                    </tr>
                    <tr>
                        <td><label for="message">Message : </label></td>
                        <td><textarea name="message" placeholder="Type your message here" rows="16"></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="send" value="Send"></td>
                    </tr>
                </table>
            </form>  
        </div>
<!-- #end content -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/sidebar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/blog/include/footer.php';
?>