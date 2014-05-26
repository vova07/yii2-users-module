<?php

namespace vova07\users\helpers;

/**
 * Extended [[yii\helpers\Security|Security]] class.
 * @package vova07\users\helpers
 */
class Security extends \yii\helpers\Security
{
    /**
     * Generate a random key with time suffix.
     * @return string Random key
     */
    public static function generateExpiringRandomKey()
    {
        return self::generateRandomKey() . '_' . time();
    }

    /**
     * Check if token is not expired.
     *
     * @param string $token Token that must be validated
     * @param integer $duration Time during token is valid
     * @return boolean true if token is not expired
     */
    public static function isValidToken($token, $duration)
    {
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return ($timestamp + $duration > time());
    }
}
