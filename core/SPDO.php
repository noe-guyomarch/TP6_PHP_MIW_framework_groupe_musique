<?php

class SPDO
{
    /** @var PDO  */
    public static $pdoInstance = null;

    /**
     * @return PDO
     */
    public static function getPdoInstance()
    {
        if (self::$pdoInstance === null) {
            //on charge l'instance de PDO
            self::$pdoInstance = new PDO(
                'mysql:host=localhost;dbname=music;charset=utf8',
                'root',
                '',
                array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)
            );
        }
        return self::$pdoInstance;
    }
}