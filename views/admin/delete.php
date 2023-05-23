<form action="" method="post" class="confirmation-form">
    <?php if (isset($user)) {
    ?>
        <p>Are you sure you want to delete User : <?= $user->getName() ?>?</p>
    <?php
    } else {
    ?>
        <p>Are you sure you want to delete Course : <?= $course->getCourseName() ?>?</p>
    <?php
    }
    ?>
    <input type="submit" name="delete" value="Delete" class="delete-btn">
    <input type="submit" name="back" value="Go Back" class="back-btn">
</form>

<style>
    .confirmation-form {
        background-color: #f1f1f1;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .confirmation-form p {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .delete-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }

    .back-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>