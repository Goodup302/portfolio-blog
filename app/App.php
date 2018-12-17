<?php
use Core\Config;
use Core\DataBase;
use App\Table\UserTable;
use App\Table\PostTable;
use App\Table\CommentTable;


class App
{
    const DEFAULT_PAGE = 'home';
    private $database;
    private $page;

    private static $instance;
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function load()
    {
        define('ROOT', dirname(__DIR__));
        define('CONFIG_FILE', ROOT . '/config.php');
        session_start();
        require_once ROOT . '/vendor/autoload.php';
        return self::getInstance()->getPageName();
    }

    public function getPageName()
    {
        $this->page = self::DEFAULT_PAGE;
        if (!empty($_GET['p'])) {
            $this->page = $_GET['p'];
        }
        return $this->page;
    }

    public function getTable($name)
    {
        $class_name = "App\\Table\\".ucfirst($name).'Table';
        return new $class_name($this->getDatabase());
    }

    public function userTable()
    {
        return new UserTable($this->getDatabase());
    }
    public function postTable()
    {
        return new UserTable($this->getDatabase());
    }
    public function commentTable()
    {
        return new CommentTable($this->getDatabase());
    }

    public function getDatabase()
    {
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

    public function error404($message = null)
    {
        if (is_null($message)) {
            $message = Config::getInstance(CONFIG_FILE)->get('default_title');
        }
        header("HTTP/1.0 404 Not Found");
        header("location:index.php?p=404&errors=".$message);
    }
}