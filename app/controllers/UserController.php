<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Model\User as US;
use App\Model\Course;
use User;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Course.php';
require_once 'BaseController.php';


class UserController extends BaseController
{

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_type'] != 'admin') {
                $courses = Course::getAllCourses($this->connect);
                require_once __DIR__ .  '/../../views/user/index.php';
            } else {
                $users = US::getAllUsers($this->connect);
                $courses = Course::getAllCourses($this->connect);
                require_once __DIR__ .  '/../../views/admin/dashboard.php';
            }
        } else {
            header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/login");
        }
    }


    public function register()
    {
        $user_name = $user_email = $user_password = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($_POST['user_name']) or empty($_POST['user_email']) or empty($_POST['password']) or empty($_POST['confirm_password'])) {
                $_SESSION['error'] = "all failed should have data";
                require 'views/user/register.php';
            } else {
                if (filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
                    $user_email = BaseController::test_data($_POST['user_email']);
                } else {
                    $_SESSION['email_error'] = "unvalid email";
                }

                if (preg_match('/^[A-Za-z]{4,}$/', $_POST['user_name'])) {
                    $user_name = BaseController::test_data($_POST['user_name']);
                } else {
                    $_SESSION['error'] = "unvalid name";
                }

                if (isset($user_name) and isset($user_email)) {
                    $user = US::getUserByEmail($this->connect, $user_email);
                    if ($user) {
                        $_SESSION['error'] = "already taken,enter another email";
                        header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/register");
                    } else {
                        header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/login");
                    }
                    if ($_POST['password'] == $_POST['confirm_password']) {
                        $user = new US();
                        $user->setName($_POST['user_name']);
                        $user->setEmail($_POST['user_email']);
                        $user->setPassword($_POST['password']);
                        $user->save($this->connect);
                        header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/login");
                    } else {
                        $_SESSION['error'] = "passwords dosen't match";
                        require 'views/user/register.php';
                    }
                } else {
                    if (isset($_SESSION['email_error'])) {
                        $_SESSION['error'] = "unvalid email";
                        require 'views/user/register.php';
                    } elseif (isset($_SESSION['name_error'])) {
                        $_SESSION['error'] = "unvalid name";
                        require 'views/user/register.php';
                    }
                }
            }
        } else {
            require 'views/user/register.php';
        }
    }


    public  function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($_POST['user_email']) or empty($_POST['password'])) {
                $_SESSION['error'] = "all failed should have data";
                require 'views/user/login.php';
            } else {
                $user = US::login($this->connect, $_POST['user_email'], $_POST['password']);
                if ($user) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['user_email'] = $user['user_email'];
                    $_SESSION['user_password'] = $user['password'];
                    $_SESSION['user_type'] = $user['user_type'];
                    header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/");
                }
                if (isset($_POST['remember'])) {
                    setcookie('user_email', $_POST['user_email'], strtotime("1 day"));
                    setcookie('user_password', $_POST['password'], strtotime("1 day"));
                }
            }
        } else {
            require 'views/user/login.php';
        }
    }

    public function delete($user_id)
    {
        $user = US::getUserById($this->connect, $user_id);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            if (isset($_POST['delete'])) {
                US::delete_user($this->connect, $user_id);
                header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/");
            } elseif (isset($_POST['back'])) {

                header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/");
                exit();
            }
        } else {
            require 'views/admin/delete.php';
        }
    }

    public function edit($user_id)
    {
        $user = US::getUserById($this->connect, $user_id);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user->setId($user_id);
            $user->setName($_POST['user_name']);
            $user->setEmail($_POST['user_email']);
            $user->setPassword($_POST['password']);
            $user->setType($_POST['type']);
            $user->save($this->connect);
            header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/");
        } else {
            require 'views/admin/edit.php';
        }
    }

    public  function logout()
    {
        session_destroy();
        if (isset($_COOKIE['user_email'])) {
            setcookie('user_email', $_COOKIE['user_email'], 1);
            setcookie('user_password', $_COOKIE['password'], 1);
        }
        header("Location:/PHPCOURSE/Darrebeni/htaccess_Task/login");
    }
}