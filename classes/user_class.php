<?php

class user_class
{

    // User data
    protected $userId = "";
    protected $login = "";
    protected $password = "";
    protected $email = "";
    protected $lastName = "";
    protected $firstName = "";
    protected $secondName = "";

    // sql connection string
    protected $link;

    public function __construct($login, $password)
    {

        if (!empty(trim($login)) && !empty(trim($password))) {

            $this->login = trim($login);
            $this->password = trim($password);

        } else {

            // deal with error
        }

        /* Database credentials. */
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_NAME', 'work');

        /* Attempt to connect to MySQL database */
        $this->link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
        if ($this->link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param string $login
     */
    public function setPassword($password)
    {
        $this->login = $password;
    }

    /**
     * @param string $email
     */
    public function setEmail ($email) {

        $this->email = $email;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName ($firstName) {

        $this->firstName = $firstName;
    }

    /**
     * @param string $secondName
     */
    public function setSecondName ($secondName) {

        $this->secondName = $secondName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName ($lastName) {

        $this->lastName = $lastName;
    }



    public function checkCredentials()
    {
        $query = "SELECT *
                    FROM users
                    WHERE login = '$this->login'";

        $result = mysqli_query($this->link, $query);

        // If user exists
        if ($result->num_rows !=0) {

            $user = mysqli_fetch_assoc($result);

            // Check pass
            if ($user['password'] == $this->password) {

                // Set user data to vars
                $this->userId = $user['id'];
                $this->email = $user['email'];
                $this->lastName = $user['last_name'];
                $this->firstName = $user['first_name'];
                $this->secondName = $user['second_name'];

                // return user data array to fill inputs with
                return $user;

            }

            // Password incorrect
            else return false;

        }
        // User does not exist
        return false;

    }

    public function checkUserExists ()
    {

        $query = "SELECT login
                    FROM users
                    WHERE login = '$this->login'";

        $result = mysqli_query($this->link, $query);

        if ($result->num_rows != 0) return true;
    }

    public function newUserRegistration()
    {

        $query = "INSERT INTO users
                    (`email`, `login`, `password`, `first_name`, `second_name`, `last_name`) 
                    VALUES ('$this->email', '$this->login', '$this->password', '$this->firstName', '$this->secondName', '$this->lastName')";

        $result = mysqli_query($this->link, $query);

        //
        return $result;

    }

    // to do user data validation if needed
    public function dataValidation()
    {
        return true;
    }

    public function changeUserData()
    {

        $query = "UPDATE users
                    SET password = '$this->password',first_name='$this->firstName',second_name='$this->secondName',last_name='$this->lastName'
                    WHERE login = '$this->login'";

        $result = mysqli_query($this->link, $query);

        return $result;

    }

    public function closeConnection () {

        mysqli_close ( $this->link );
        $this->link = NULL;

    }

}