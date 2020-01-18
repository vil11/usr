<?php

class badgeTest extends tests_abstract
{
    public function dataUnits()
    {
        $legionList = parseCsvTable(PROJECT_PATH . '/data/legion.csv');
        $provider = prepareDataProvider($legionList);

        return $provider;
    }

    /**
     * @test
     */
    public function badgeIsUnique()
    {
    }

    /**
     * @test
     *
     * @dataProvider dataUnits
     * @param array $unitData
     */
    public function badgeFormat(array $unitData)
    {
        $unit = new model_unit($unitData);
        $actualBadge = $unit->getBadge();

        $this->assertTrue(is_numeric($actualBadge), 'error02-1');
        $this->assertEquals(4, strlen($actualBadge), 'error02-2');
    }

    /**
     * @test
     *
     * @dataProvider dataUnits
     * @param array $unitData
     */
    public function platoonValid(array $unitData)
    {
        $unit = new model_unit($unitData);
        $expectedPlatoon = $this->getUnitPlatoonName($unit->getBadge());
        $actualPlatoon = $unit->getPlatoon();

        $this->assertEquals($expectedPlatoon, $actualPlatoon, 'error03');
    }
}
