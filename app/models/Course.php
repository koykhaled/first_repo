<?php

namespace App\Model;

use PDO;

require_once 'Model.php';

class Course extends Model
{
    private $course_name, $course_price;

    public function setCourseName($course_name)
    {
        $this->course_name = $course_name;
    }

    public function setCoursePrice($course_price)
    {
        $this->course_price = $course_price;
    }

    public function getCourseName()
    {
        return $this->course_name;
    }

    public function getCoursePrice()
    {
        return $this->course_price;
    }

    public function save($connect)
    {
        if ($this->id) {
            $update = "UPDATE courses SET
            course_name = '$this->course_name',
            course_price = '$this->course_price'
            where course_id = '$this->id'
            ";
            $query = mysqli_query($connect, $update);
        } else {
            $insert = "INSERT INTO courses(course_name,course_price) values('$this->course_name','$this->course_price')";
        }
    }

    public static function getAllCourses($connect)
    {
        $select = "SELECT * FROM courses";
        $query = $connect->query($select);
        $courses = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $course = new Course();
            $course->setId($row['course_id']);
            $course->setCourseName($row['course_name']);
            $course->setCoursePrice($row['course_price']);
            $courses[] = $course;
        }
        return $courses;
    }

    public static function getCourseById($connect, $course_id)
    {
        $select = "SELECT * FROM courses where course_id = '$course_id'";
        $query = mysqli_query($connect, $select);
        $result = mysqli_fetch_assoc($query);
        $course = new Course();
        $course->setId($result['course_id']);
        $course->setCourseName($result['course_name']);
        $course->setCoursePrice($result['course_price']);
        return $course;
    }

    public static function delete_course($connect, $course_id)
    {
        $delete = "DELETE  FROM courses where course_id ='$course_id'";
        $query = mysqli_query($connect, $delete);
    }
}