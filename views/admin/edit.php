<?php
if (isset($user)) {
?>
<h1>Edit User</h1>

<form method="post" action="" class="edit-form">
    <div class="form-group">
        <label for="name">User Name:</label>
        <input type="text" name="user_name" id="name" value="<?= $user->getName() ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">User Email:</label>
        <input type="text" name="user_email" id="email" value="<?= $user->getEmail() ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">User Password:</label>
        <input type="password" name="password" id="password" value="<?= $user->getPassword() ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">User Type:</label>
        User<input type="checkbox" name="type" id="type" value="user" class="form-control">
        Employee<input type="checkbox" name="type" id="type" value="employee" class="form-control">
    </div>
    <input type="submit" value="Update" class="btn btn-primary">
</form>
<?php
} else {
?>
<h1>Edit User</h1>

<form method="post" action="" class="edit-form">
    <div class="form-group">
        <label for="name">Course Name:</label>
        <input type="text" name="course_name" id="name" value="<?= $course->getCourseName() ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Course Price:</label>
        <input type="text" name="course_price" id="email" value="<?= $course->getCoursePrice() ?>" class="form-control">
    </div>
    <input type="submit" value="Update" class="btn btn-primary">
</form>
<?php
}