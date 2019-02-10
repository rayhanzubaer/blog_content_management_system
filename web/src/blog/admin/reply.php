<?php
include("include/header.php");
include("include/sidebar.php");
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to = sanitize($_POST['to']);
    $from = sanitize($_POST['from']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);
    
    $validate = new Validate();
    $validation = $validate->check(array($to, $from, $subject, $message));

    if ($validation->pass()) {
        $result = mail($to, $subject, $message, $from);
    
        if($result){
            echo "<p class='alert alert-success'>message sent successfully.</p>";
        }
        else{
            echo "<p class='alert alert-danger'>message sent failed.</p>";
        }
    }
    else{
        echo "<p class='alert alert-danger'>message sent failed.</p>";
    }
}
?>
<?php
if (isset($_GET['r_id'])) {
    $r_id = $_GET['r_id'];

    $sql = "SELECT * FROM contact WHERE id='$r_id';";
    $result = DB::getInstance()->select($sql);

    if ($result) {
        $value = $result->fetch_object();
?>
    <h1 class="text-center">Reply Message</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="to">To :</label>
                <input type="text" name="to" value="<?php echo $value->email; ?>" readonly class="form-control">
            </div>
            <div class="form-group">
                <label for="from">From :</label>
                <input type="text" name="from" value="" placeholder="type your email" class="form-control">
            </div>
            <div class="form-group">
                <label for="subject">Subject :</label>
                <input type="text" name="subject" value="" placeholder="type your email subject" class="form-control">
            </div>
            <div class="form-group">
                <label for="message">Message :</label>
                <textarea name="message" placeholder="type your message" class="form-control">
                </textarea>
            </div>
            <div class="form-group col-md-offset-5">
                <input type="submit" name="submit" value="Send" class="btn btn-primary btn-lg">
            </div>
        </form>           
<?php
    }
}
?>    

<?php
include("include/footer.php");
?>