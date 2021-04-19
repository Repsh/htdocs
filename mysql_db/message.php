<!DOCTYPE html>
<a href="index.php">Main</a>
<link rel="stylesheet" href="message.css">

<div class="container">
    <form action="">
        <?php
            include 'DB.php';
            $db = new DB('localhost', 'root', 'root', 'mysql_db');

            if (array_key_exists('update', $_GET)) {
                $id = $_GET['update'];
                $message = $db->find($id);
                if ($message !== []) {
                    echo "<h3><a href='/'>&lt;-</a> Atjauninam ierakstu ar id $id</h3>";
                    echo "<input type='hidden' name='update-id' value='$id'>";
                }
            }
            else {
                $message = [];
            }
        ?>

        <label for="email">Epasts</label>
        <input id="email" type="email" name="email" value="<?= text(@$message['email']); ?>">

        <label for="phone">Tālruņa nummurs</label>
        <input id="phone" type="phone" name="phone" value="<?= text(@$message['phone']); ?>">

        <label for="description">Apraksts</label>
        <textarea name="description" id="description" cols="30" rows="10" value="<?= text(@$message['description']); ?>"></textarea>
        
        <button type="submit">Iesniegt</button>
    </form>



<?php 
    if (
        array_key_exists('email', $_GET) &&
        array_key_exists('phone', $_GET) &&
        array_key_exists('description', $_GET) &&
        is_string($_GET['email']) &&
        is_string($_GET['phone']) &&
        is_string($_GET['description'])
    ) {
        if (
            array_key_exists('update-id', $_GET) &&
            is_numeric($_GET['update-id'])
        ) {
            $db->update(
                'messages',
                [
                    'email' => $_GET['update-id'],
                    'phone' => $_GET['phone'],
                    'description' => $_GET['description']
                ]
            );
        }
        else {  
             $db->add(
                'messages',
                [
                    'email' => $_GET['email'],
                    'phone' => $_GET['phone'],
                    'description' => $_GET['description']
                ]
            );
        }
    }

    if (array_key_exists('delete', $_GET)) {
        $id = (int) $_GET['delete'];
        $db->delete('messages', $id);
    }

    foreach  ($db->getAll() as $row) {
        echo "<p>";
        echo "<b>" . $row['id'] . "</b>";
        echo "email:" . text($row['email']);
        echo " phone:" . text($row['phone']);
        echo " description:" . text($row['description']);
        echo " <a href='?delete=" . $row['id'] . "'>delete</a>";
        echo " <a href='?update=" . $row['id'] . "'>update</a>";
        echo "</p>";
    }

    function text($string) {
        return htmlentities($string);
    }


?>
</div>