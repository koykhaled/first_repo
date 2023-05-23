<h2>Courses</h2>
<?php
foreach ($courses as $course) {
?>
<div class="user">
    <p><?= $course->getId() ?>-Course Name : <?= $course->getCourseName() ?> </p>
    <p>Course Price : <?= $course->getCoursePrice() ?> </p>
    <?php if ($_SESSION['user_type'] != "admin") {
        ?>
    <a href="/PHPCOURSE/Darrebeni/htaccess_Task/buy"><button>Buy</button></a>
    <?php
        } else {
        ?>
    <div class="user-buttons">
        <a href="/PHPCOURSE/Darrebeni/htaccess_Task/delete-course/<?= $course->getId() ?>" class="delete-btn">Delete</a>
        <a href="/PHPCOURSE/Darrebeni/htaccess_Task/edit-course/<?= $course->getId() ?>" class="edit-btn">Edit</a>
    </div>
</div>
<?php
        } ?>
<hr>
<?php
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