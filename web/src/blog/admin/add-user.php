<?php
include("include/header.php");
include("include/sidebar.php");
?>
        <div class="content">
            <h2>Add New User</h2>
<?php
if(!empty($_POST)){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $query = "INSERT INTO user_info(username, password, role) VALUES ('$username', '$password', '$role');";
    $result = $db->query($query);
    if(!empty($result)){
        echo "<span class='success'>new user added succesfully.";
    }
    else{
        echo "<span class='error'>new user added failed.</span>";
    }
}
?>
            <div class="entry">
                <form method="post" action="">
                    <table>
                        <tr>
                            <td><label for="username">Username :</label></td>
                            <td><input type="text" name="username" placeholder="username"></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password :</label></td>
                            <td><input type="password" name="password" placeholder="password"></td>
                        </tr>
                        <tr>
                            <td><label for="role">Role :</label></td>
                            <td>
                                <select name="role">
                                    <option>Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Author</option>
                                    <option value="3">Editor</option>
                                </select>
                                </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="submit" value="Save"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
<?php
include("include/footer.php");
?>