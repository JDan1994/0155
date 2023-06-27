<?php 
class Person {
    private $name;
    private $lastname;
    private $age;
    private $hp;
    private $father;
    private $mother;

    function __construct($name, $lastname, $age, $mother=null, $father=null)
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->mother = $mother;
        $this->father = $father;
        $this->hp = 100;
    }

    function sayHi($name)
    {
        return "Hi $name, I am " . $this->name;
    }

    function setHp($hp) {
        if ($this->hp + $hp >= 100) $this->hp = 100;
        else $this->hp = $this->hp + $hp;
    }

    function getHp() {
        return $this->hp;
    }

    function getName() {
        return $this->name;
    }
    function getLastname() {
        return $this->lastname;
    }
    function getMother() {
        return $this->mother;
    }
    function getFather() {
        return $this->father;
    }
    function getInfo() {
        return "<h3>Пара слов обо мне: </h3><br>" . 
        "Мое имя: " . $this->getName() . 
        "<br> Моя фамилия: " . $this->getLastname() . 
        "<br>Моего папу зовут: " . $this->getFather()->getName() . " " .  $this->getFather()->getLastname() . 
        "<br>Мою маму зовут: " . $this->getMother()->getName() .  " " .  $this->getMother()->getLastname() .
        "<br>Моего деда (по линии отца) зовут: " . $this->getFather()->getFather()->getName() . " " .  $this->getFather()->getFather()->getLastname() .
        "<br>Мою бабушку (по линни отца) зовут: " . $this->getFather()->getMother()->getName() . " " .  $this->getFather()->getMother()->getLastname() .
        "<br>Моего деда (по линии матери) зовут: " . $this->getMother()->getFather()->getName() . " " . $this->getMother()->getFather()->getLastname() .
        "<br>Мою бабушку (по линни матери) зовут: " . $this->getMother()->getMother()->getName() . " " .  $this->getMother()->getMother()->getLastname();
        //Вывести данные обо всей родне, включая бабушек и дедушек
    }
}

$alex = new Person("Alex", "Ivanov", 72);
$fekla = new Person("Fekla", "Ivanova", 67);
$anton = new Person("Anton", "Petrov", 94);
$janna = new Person("Janna", "Titova", 86);
$igor = new Person("Igor", "Petrov", 40, $janna, $anton);
$olga = new Person("Olga", "Petrova", 38, $fekla, $alex);
$valera = new Person("Valera", "Petrov", 10, $olga, $igor);

echo $valera->getInfo();
//Здоровье человека не может быть больше 100

// echo $alex->sayHi($igor->name) . "<br>";
// echo $igor->sayHi($alex->name);
// $medkit = 50;
// $alex->setHp(-30);//упал
// echo $alex->getHp() . "<br>";
// $alex->setHp($medkit);//Нашел аптечку
// echo $alex->getHp();