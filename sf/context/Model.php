<?php

namespace SF\Context;

use mysqli;
use SF\Foundation\Application;

class Model
{
    private $mysqli;
    private $className;
    private $nameSpace;

    public function __construct()
    {
        $conf = Application::get()->getAppConfig()['database'];
        extract($conf);
        $this->mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

        $fullName = $this->splitClassFullName(get_class($this));
        $this->className = $fullName['className'];
        $this->nameSpace = $fullName['nameSpace'];
    }

    public function getAll()
    {
        $query = $this->mysqli->query("SELECT * FROM `{$this->className}s`");
        $result = [];
        while($row = $query->fetch_assoc())
        {
            $result[] = $row;
        }
        return $result;
    }

    private function splitClassFullName($fullName)
    {
        $pattern = '#^(?<nameSpace>.+)\\\\(?<className>.+)$#';

        if(preg_match($pattern, $fullName, $matches))
        {
            return $matches;
        }

        throw new \Exception("Неверное имя класса $fullName");
    }
}