<?php

class Model
{
    public $bdd;
    /**
     * StreamerModel constructor va peupler les valeur de l'objet
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->bdd = self::getBdd();
        foreach ($data as $key=>$value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function getBdd()
    {
        return SPDO::getPdoInstance();
    }
}