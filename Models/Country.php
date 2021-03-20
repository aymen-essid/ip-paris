<?php

namespace Models;


class Country extends Connexion
{
    private $id;

    private $countryName;

    public function __construct($connexion){
        $this->connexion = $connexion;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param mixed $countryName
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }

    public function getCountries(){

        $htmlList = '';
        $sql = "SELECT *  FROM country";
        $result = $this->connexion->query($sql);
        if($result->num_rows > 0){
            while ($row = $result->fetch_array()) {
                $htmlList .= '
                    <option value="'.$row['id'].'">'.$row['countryName'].'</option>
                ';
            }
            echo $htmlList;
        }
    }

    public function getCountryById($id){

        $sql = "SELECT countryName FROM country WHERE id =". htmlspecialchars($id) ;
        $result = $this->connexion->query($sql);
        if($result->num_rows > 0)
            while ($row = $result->fetch_array()) {
                return $row['countryName'];
            }
        return;
    }
}