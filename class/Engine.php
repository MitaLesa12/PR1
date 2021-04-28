<?php
/**
* Простой движок на PHP
* @author Company.ru
*/
class Engine {
private $_page_file = null;
private $_error = null;
public function __construct() {
if (isset($_GET["page"])) { //Если открыта какая-нибудь страница
//Записываем в переменную имя открытого файла (из GET запроса)
$this->_page_file = $_GET["page"];
//Небольшая защита
$this->_page_file = str_replace(".", null, $_GET["page"]);
$this->_page_file = str_replace("/", null, $_GET["page"]);
$this->_page_file = str_replace("", null, $_GET["page"]);
//Проверяем, если шаблон не существует
if (!file_exists("templates/" . $this->_page_file . ".php")) {
$this->_setError("Шаблон не найден"); //Ошибку на экран
$this->_page_file = "main"; //Открываем главную страницу
}
}
//Если в GET запросе нет переменной page, то открываем главную
else $this->_page_file = "main";
}
/**
* Записывает ошибку в переменную _error
* @param string $error - текст ошибки
* @author Company.ru
*/
private function _setError($error) {
$this->_error = $error;
}
/**
* Возвращает текст ошибки
* @author Company.ru
*/
public function getError() {
    return $this->_error;
    }
    /**
    * Возвращает текст открытой страницы
    */
    public function getContentPage() {
    return file_get_contents("templates/" . $this->_page_file . ".php");
    }
    /**
    * Возвращает тег заголовок открытой страницы
    * @return string
    */
    public function getTitle() {
    switch ($this->_page_file) {
    case "main":
    return "Главная страница сайта Company.ru";
    break;
    case "about":
    return "О компании Company.ru";
    break;
    case "Company":
    return "Преимущества Company.ru";
    break;
    default:
    break;
    }
    }
    }
    ?>
  
