<?php

namespace tests\unit\models;

use app\models\Cube;

class CubeTest extends \Codeception\Test\Unit
{
    public function testQueriesCube()
    {
        $cube = new Cube(4, 5);
        $cube->updateValue(2, 2, 2, 4);
        expect($result = $cube->query(1, 1, 1, 3, 3, 3))->equals(4);
        $cube->updateValue(1, 1, 1, 23);
        expect($result = $cube->query(2, 2, 2, 4, 4, 4))->equals(4);
        expect($result = $cube->query(1, 1, 1, 3, 3, 3))->equals(27);
    }
}
