<?php

namespace Odf\tests;

require_once 'Classes/Ficheros.php';

use Odf\Classes\Ficheros;

/**
 * Class FicherosTest
 * @package Odf\tests
 */

class FicherosTest extends \PHPUnit_Framework_TestCase
{
    public function testFicheros()
    {
        $this->assertTrue(class_exists('Odf\Classes\Ficheros'));
    }

}
