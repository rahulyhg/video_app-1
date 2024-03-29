<?php

namespace Core;

use Core\Config;

use \PDO;
use NotORM;

class App {
    /**
     * Bootstraps the application.
     * 
     * @return void
     */
    public function bootstrap() {
        // start the session
        session_start();

        // set the language, if there is no language already set
        if (! $this->getLocale()) {
            $this->setLocale();
        }

        // connect the app to the database
        $this->connectToDatabase();

        // perform app cleanup
        $this->cleanup();
    }

    /**
     * Conenct the app to the database
     * 
     * @return
     */
    private function connectToDatabase() {
        try {
            // get the config
            $dbConfig = Config::get('database');

            // create a PDO database connection
            $pdo = new PDO(
                "mysql:host=" . $dbConfig['db_host'].
                ";dbname=" . $dbConfig['db_name'].
                ";charset = UTF8",
                $dbConfig['db_user'],
                $dbConfig['db_pass']
            );

            // configure the connection
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $settings = $pdo->prepare("SET SESSION sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';");
            $settings->execute();

            $db = new NotORM($pdo);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            die("Database error encountered");
        }

        // assign the database to the app object
        $this->database = $db;
    }

    /**
     * Gets the instance of app's database
     * 
     * @return Object
     */
    public function getDatabase() {
        if ($this->database != NULL) {
            return $this->database;
        }
        else {
            return false;
        }
    }

    /**
     * Sets the language from session on start of the application.
     * 
     * @param string $language
     * @return void
     */
    public function setLocale($language = "sk") {
        $_SESSION["language"] = $language;
    }

    /**
     * Resolve the current locale of the app.
     * 
     * @return string
     */
    public function getLocale() {
        if(array_key_exists("language",$_SESSION) && !empty($_SESSION["language"])) {
            return $_SESSION["language"];
        } else {
            return false;
        }
    }

    /**
     * Takes care of necessary cleanup actions
     */
    private function cleanup() {
        // empty out the flash message session variable
        $_SESSION["flash_message"] = [];
        unset($_SESSION["flash_message"]);
    }
}
