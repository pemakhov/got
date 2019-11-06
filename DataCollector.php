<?php


class DataCollector
{
    const DIR_NAME = 'users/';
    private string $email;
    private string $fName;
    private array $user;
    private array $existingFNames;

    function __construct()
    {
        if(!isset($_POST) || sizeof($_POST) === 0) {
            return;
        }

        $this->existingFNames = $this->getFileNames();
        $this->fName = $this->makeFName($this->email);

        /* Create user and write first part of data */
        if (isset($_POST['email'], $_POST['password'])) {
            if (in_array($this->fName, $this->existingFNames)) {
                $_SESSION['invEmailMessage'] = 'User with this email already exists';
                return;
            }
            $this->makeUserDataFile();
            return;
        }
        if (isset($_SESSION['email'])) {
            $this->appendUserDataFile();
        }
    }

    function makeUserDataFile()
    {
        if (!isset($_SESSION['invEmailMessage'], $_SESSION['invPassMessage'])) {
            return;
        }
        if (strlen($_SESSION['invEmailMessage']) > 0 || strlen($_SESSION['invPassMessage']) > 0) {
            return;
        }
        $_SESSION['email'] = $_POST['email'];
        $this->email = $_POST['email'];
        $this->user = $this->makeUser();
        $this->writeToFile(json_encode($this->user), $this->fName);
    }

    function appendUserDataFile()
    {
        if (!isset($_SESSION['invNameMessage'],
            $_SESSION['invHouseMessage'],
            $_SESSION['invHobbiesMessage'])) {
            return;
        }
        if (strlen($_SESSION['invNameMessage']) > 0 &&
            strlen($_SESSION['invHouseMessage']) > 0 &&
            strlen($_SESSION['invHobbiesMessage']) > 0) {
            return;
        }
        //todo: read append and write user data
    }


    /* Opens file for reading, reads and returns its content */
    function getFileContent($fName)
    {
        $file = fopen($fName, 'r+') or die('Unable to open file.');
        $txt = fread($file, filesize($fName));
        fclose($file);
        return $txt;
    }

    /* Opens file for writing, replaces its content */
    function writeToFile($txt, $fName)
    {
        $file = fopen($fName, 'w+') or die('Unable to open file.');
        fwrite($file, $txt);
        fclose($file);
    }

    function makeFName($email)
    {
        return self::DIR_NAME . preg_replace('/[^A-Za-z0-9\-@._]/', '-', $email);
    }

    function makeUser()
    {
        $newUser = array();
        foreach ($_POST as $key => $value) {
            $newUser[$key] = $value;
        }
        return $newUser;
    }

    /*
     * Returns names of all files in the DIR_NAME directory.
     */
    private function getFileNames()
    {
        return array_diff(scandir(self::DIR_NAME), array('.', '..'));
    }

}