<?php

abstract class tests_abstract extends PHPUnit_Framework_TestCase
{
    public function getUnitPlatoonName($badge)
    {
        $platoonsList = parseCsvTable(PROJECT_PATH . '/data/platoons.csv');
        $mysqlRequest = 'select';
    }
}
