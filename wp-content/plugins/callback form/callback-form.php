<?php

/*
  Plugin Name: Custom Callback form
  Plugin URI: http://code.tutsplus.com
  Description: Форма обратной связи
  Version: 1.0
  Author: Stepan Kupryashin
 */

function callback_form() {
echo '
<style>
form {
    margin: auto;
    position: relative;
    display: flex;
    flex-direction: column;
}
input {
margin: auto;
margin-bottom: 20px;
margin-top: 20px;
}
</style>
';
if ($_POST) {
    $link = mysqli_connect("localhost", "root", "", "wp-db");
    $username = $_POST['username'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];
    $sql = "INSERT INTO `callback-messages` (`username`, `email`, `number`, `message`) VALUES ('$username', '$email',   $number , '$message')";
    $result = mysqli_query($link, $sql);
    if ($result == false) {
        print("Ошибка :(");
        print(mysqli_error($link));
    }
    mysqli_commit($link);
    echo '
<h1>Cообщение отправлено!
'  . $_POST["username"] . '</h1>';

}
else {
    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <label for="username">Имя<strong>*</strong></label>
    <input type="text" name="username" value="">
    <label for="email">E-mail <strong>*</strong></label>
    <input type="text" name="email" value="">
    <label>Номер телефона</label>
    <input type="number" name="number" value="">
    <label for="message">Соообщение</label>
    <textarea name="message"></textarea>
    <input type="submit" name="submit" value="Send"/>
    </form>
    ';
}



}

add_shortcode( 'callback-form', 'callback_form' );

// Обратный вызов функции, которая заменит [callback-form]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}




add_action( 'admin_menu', 'settings_page_init' );

function settings_page_init() {
    add_menu_page("Обратная связь", "Обратная связь", "edit_theme_options", __FILE__, "callback_view");
}
function callback_view() {
    ?>
    <h2>Админ панель формы обратной связи</h2>
     <?php
    $link = mysqli_connect("localhost", "root", "", "wp-db");
    $sql = "SELECT * FROM `callback-messages`";
    $result = mysqli_query($link, $sql);
    echo "<table>";
    foreach ($result as $row) {
        echo "
<tr>
    <th>" .
    $row['username']. "
</th>
<th>
" .
            $row['email']. "
</th>
<th>
" .
            $row['number']. "
</th>
<th>
" .
            $row['message']. "
</th>
</tr>";

    }
    echo "</table>";
    echo "
    <style>
    table {
    position: relative;
    left: calc(50% - 50%/2);
    width: 50%;
    align-content: center;
    border: 2px solid slategray;
    border-radius: 10px; 
    }
    th, td {
    border: 1px solid darkgrey;
    border-radius: 8px;
    }
    </style>
    
    ";
    ?>
    <?php
}