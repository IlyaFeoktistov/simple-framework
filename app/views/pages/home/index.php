<p> это главная </p>

<?php
    foreach($users as $user)
    {
        echo "<p> {$user['id']} | {$user['login']} | {$user['email']} </p>";
    }
?>