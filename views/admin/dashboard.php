<h1>Users</h1>
<?php
require __DIR__ . '/../nav.php';

if (isset($_SESSION['user_email'])) {
    echo '<br> Hello ' . $_SESSION['user_name'];
}
foreach ($users as $user) {
    if ($user->getType() != 'admin') {
?>
        <div class="user">
            <p class="user-info"><?php echo $user->getId() .  "- User Name: " . $user->getName() ?></p>
            <p class="user-info"><?php echo "User Email: " . $user->getEmail() ?></p>
            <div class="user-buttons">
                <a href="/PHPCOURSE/Darrebeni/htaccess_Task/delete/<?= $user->getId() ?>" class="delete-btn">Delete</a>
                <a href="/PHPCOURSE/Darrebeni/htaccess_Task/edit/<?= $user->getId() ?>" class="edit-btn">Edit</a>
            </div>
        </div>
        <hr>
<?php
    }
}
?>



<style>
    .user {
        background-color: #f1f1f1;
        padding: 20px;
        border-radius: 5px;
    }

    .user-info {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .user-buttons a {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        text-decoration: none;
    }

    .delete-btn {
        background-color: red;
    }

    .edit-btn {
        background-color: #28a745;
    }

    .user-buttons a:hover {
        opacity: 0.8;
    }

    hr {
        margin: 20px 0;
        border: none;
        border-top: 1px solid #ccc;
    }
</style>