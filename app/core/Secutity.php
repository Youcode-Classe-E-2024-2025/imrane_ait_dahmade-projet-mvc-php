<?php

namespace App\Core;


class Security
{
    public static function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public static function generateToken($length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    public static function validateToken($token, $sessionToken)
    {
        return hash_equals($token, $sessionToken);
    }
}
?>