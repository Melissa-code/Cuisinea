<?php

/**
 * Create a new user
 *
 * @param PDO $pdo
 * @param string $firstname
 * @param string $lastname
 * @param string $login
 * @param string $password
 * @param string $role
 * @return bool
 */
function addUser(PDO $pdo, string $firstname, string $lastname, string $login, string $password, string $role = "user"): bool
{
    $sql = "INSERT INTO users (id, email, password, first_name, last_name, role) VALUES (NULL, :login, :password, :firstname, :lastname, :role)";
    $query = $pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query->bindParam(":login", $login, PDO::PARAM_STR);
    $query->bindParam(":password", $password, PDO::PARAM_STR);
    $query->bindParam(":firstname", $firstname, PDO::PARAM_STR);
    $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
    $query->bindParam(":role", $role, PDO::PARAM_STR);
    return $query->execute();
}

/**
 * @param $pdo
 * @param $login
 * @param $password
 * @return false|array
 */
function verifyUser($pdo, $login, $password): array|false {
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :login");
    $query->bindParam(":login", $login, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if($user && password_verify($_POST['password'], $user['password'])) {
        return $user;
    } else {
        return false;
    }

}