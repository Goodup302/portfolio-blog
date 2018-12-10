<?php
use Core\Config;
use Core\DataBase;


class App
{
    private $database;
    private $page;

    private static $_instance;
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->title = Config::getInstance(CONFIG_FILE)->get('default_title');
    }

    public static function load() {
        define('ROOT', dirname(__DIR__));
        define('CONFIG_FILE', ROOT . '/config.php');
        session_start();
        //
        require_once ROOT . '/vendor/autoload.php';
        require_once ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require_once ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
        //
        return self::getInstance()->getPageName();
    }


    public function getPageName() {
        $this->page = 'home';
        if (!empty($_GET['p'])) {
            $this->page = $_GET['p'];
        }
        return $this->page;
    }


    public function getTable($name) {
        $class_name = "App\\Table\\".ucfirst($name).'Table';
        return new $class_name($this->getDatabase());
    }

    public function getDatabase() {
        if (is_null($this->database)) {
            $config = Config::getInstance(CONFIG_FILE);
            $this->database = new DataBase(
                $config->get('db_name'),
                $config->get('db_host'),
                $config->get('db_user'),
                $config->get('db_pass')
            );
        }
        return $this->database;
    }

    public function error404($message = null) {
        if (is_null($message)) {
            $message = Config::getInstance(CONFIG_FILE)->get('default_title');
        }
        header("HTTP/1.0 404 Not Found");
        header("location:index.php?p=404&errors=".$message);
    }
}