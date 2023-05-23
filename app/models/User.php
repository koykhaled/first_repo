<?php


namespace App\Model;

use PDO;

session_start();
require_once 'Model.php';

class User extends Model
{
    private $user_name, $user_email, $user_type, $password;

    public function setName($user_name)
    {
        $this->user_name = $user_name;
    }

    public function setType($user_type)
    {
        $this->user_type = $user_type;
    }

    public function setEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    public function setPassword($user_password)
    {
        $this->password = $user_password;
    }

    public function getName()
    {
        return $this->user_name;
    }
    public function getType()
    {
        return $this->user_type;
    }
    public function getEmail()
    {
        return $this->user_email;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public static function getAllUsers($connect)
    {
        $results = Model::getAll($connect, 'users');
        $users = array();
        foreach ($results as $result) {
            $user = new User();
            $user->setId($result['user_id']);
            $user->setName($result['user_name']);
            $user->setEmail($result['user_email']);
            $user->setPassword($result['password']);
            $users[] = $user;
        }
        return $users;
    }


    public function save($connect)
    {
        if ($this->id) {
            $update = "UPDATE users SET user_name = :user_name, user_email = :user_email,user_type=:user_type,password=:user_password where user_id = :user_id";

            $query = $connect->prepare($update);
            $query->execute([
                'user_name' => $this->user_name,
                'user_email' => $this->user_email,
                'user_type' => $this->user_type,
                'user_password' => $this->password,
                'user_id' => $this->id
            ]);
        } else {
            $insert = "INSERT INTO users(user_name,user_email,user_type,password) values(:user_name,:user_email,:user_type,:user_password)";
            $query = $connect->prepare($insert);
            $query->execute([
                'user_name' => $this->user_name,
                'user_email' => $this->user_email,
                'user_type' => 'user',
                'user_password' => $this->password,
            ]);
        }
    }

    public static function delete_user($connect, $id)
    {
        $delete = "DELETE FROM users where user_id=:user_id";
        $query = $connect->prepare($delete);
        $query->execute(['user_id' => $id]);
    }

    public static function login($connect, $user_email, $user_password)
    {
        $select = "SELECT * FROM users where user_email = :user_email and password = :user_password";
        $query = $connect->prepare($select);
        $query->execute(['user_email' => $user_email, 'user_password' => $user_password]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public static function getUserByEmail($connect, $user_email)
    {
        $select = "SELECT * FROM users where user_email = :user_email";
        $query = $connect->prepare($select);
        $query->execute(['user_email' => $user_email]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            $user = new User();
            $user->setName($row['user_name']);
            $user->setEmail($row['user_email']);
            $user->setPassword($row['password']);
            return $user;
        } else {
            return false;
        }
    }

    public static function getUserById($connect, $user_id)
    {
        $select = "SELECT * FROM users where user_id = :user_id";
        $query = $connect->prepare($select);
        $query->execute(['user_id' => $user_id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            $user = new User();
            $user->setName($row['user_name']);
            $user->setEmail($row['user_email']);
            $user->setPassword($row['password']);
            return $user;
        } else {
            return false;
        }
    }
}