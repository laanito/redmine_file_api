<?php

namespace Odf\tests;

use Odf\Classes\Ficheros;

class FicherosTest extends \PHPUnit_Framework_TestCase
{
    public function testFicheros()
    {
        $this->assertTrue(class_exists('Odf\Classes\Ficheros'));
    }

}
