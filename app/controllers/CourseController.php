<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Model\Course as CC;

require_once __DIR__ . '/../models/Course.php';
require_once 'BaseController.php';

class CourseController extends BaseController
{
    public function index()
    {
        $courses = CC::getAllCourses($this->connect);
        require __DIR__ . '/../../views/course/index.php';
    }

    public function delete($course_id)
    {
        $course = CC::getCourseById($this->connect, $course_id);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            if (isset($_POST['delete'])) {
                CC::delete_course($this->connect, $course_id);
                header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/");
            } elseif (isset($_POST['back'])) {

                header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/");
                exit();
            }
        } else {
            require 'views/admin/delete.php';
        }
    }
    public function edit($course_id)
    {
        $course = CC::getCourseById($this->connect, $course_id);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $course->setId($course_id);
            $course->setCourseName($_POST['course_name']);
            $course->setCoursePrice($_POST['course_price']);

            $course->save($this->connect);
            header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/");
        } else {
            require 'views/admin/edit.php';
        }
    }
}