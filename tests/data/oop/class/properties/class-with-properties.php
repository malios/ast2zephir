<?php

namespace Malios;

class Foo
{
    var $bar = 1;
    public $arr = [1, 2, 3.14];
    private $arrLong = array("red", "green", "black");
    protected $a = null, $b;
    private static $c = "Lorem";
    private $assoc = ["foo" => "bar", "baz" => "qux"];
    private $mixed = ["foo" => "bar", "baz", 42];
}
