<?php

namespace Malios;

class Hello
{
    public function sayHelloToTheBrowser()
    {
        $message = 'world';
        ?>
<h1>Hello! <?php echo $message; ?></h1><?php
    }
}
