<?php

namespace Models;


class User extends Connexion
{
    private $id;

    private $firstName;

    private $lastName;

    Private $country;


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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getUsers(){

        $htmlList = '';
        $sql = "SELECT *  FROM user";
        $result = $this->connexion->query($sql);
        if($result->num_rows > 0){
            while ($row = $result->fetch_array()) {
                $country = new Country($this->connexion);
                $htmlList .= '
                    <tr>
                        <th scope="row">'. $row["id"] .'</th>
                        <td>'. $row["firstname"] .'</td>
                        <td>'. $row["lastname"] .'</td>
                        <td>'. $country->getCountryById($row["country"]) .'</td>
                    </tr>
                ';
            }
            echo $htmlList;
        }
        else
            echo 'Aucun utilisateur dans cette liste';
    }

    public function addUser($data){

        if(!$this->userExist($data['firstname'], $data['lastname'])){
            $sql = "INSERT INTO user (firstname, lastname, country)
                    VALUES ('".htmlspecialchars($data['firstname'])."', '".htmlspecialchars($data['lastname'])."', '".htmlspecialchars($data['country'])."');";
            if($this->connexion->query($sql))
                return array('messagee' => 'Utilisateur Ajouté avec succès', 'alerte' => 'SUCCESS', 'code' => 200);
            else
                return array('messagee' => "Problème d'insertion", 'alerte' => 'ERROR', 'code' => 500);
        }
        else
            return array('messagee' => 'Utilisateur existant', 'alerte' => 'ERROR', 'code' => 401);
    }

    public function userExist($firstname, $lastname){

        $sql = "SELECT *  FROM user WHERE firstname LIKE '". htmlspecialchars($firstname) ."' AND lastname LIKE '". htmlspecialchars($lastname) ."'";
        $result = $this->connexion->query($sql);
        if($result->num_rows > 0)
            return true;

        return false;
    }

    public function getUserById($id){

        $sql = "SELECT * FROM country WHERE id =". htmlspecialchars($id) ;
        $result = $this->connexion->query($sql);
        if($result->num_rows > 0)
            return $result;

        return;
    }

    public function checkUserFields($data){

        if(count($data) > 0)
            foreach ($data as $key => $input) {
                if (!isset($data[$key]) || empty($data[$key])) {
                    return false;
                }
            }
        return true;
    }
}