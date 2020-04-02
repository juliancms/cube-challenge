<?php

namespace app\models;

class Cube
{
    private $m, $n, $cube;

    function __construct($n, $m)
    {
        $this->m = $m;
        $this->n = $n;
        $this->buildCube($n);
    }

    /**
     * Creates the cube with 0 value
     * @return bool
     */
    private function buildCube($n)
    {
        for ($i = 0; $i <= $n; $i++) {
            for ($j = 0; $j <= $n; $j++) {
                for ($k = 0; $k <= $n; $k++) {
                    $this->cube[$i][$j][$k] = 0;
                }
            }
        }
    }

    /**
     * Updates the cube
     * @return bool
     */
    public function updateValue($x, $y, $z, $value)
    {
        $this->cube[$x][$y][$z] = $value;
    }

    /**
     * Calculate the value of the Cube
     * @return string
     */
    public function query($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $sum = 0;
        for ($i = $x1; $i <= $x2; $i++) {
            for ($j = $y1; $j <= $y2; $j++) {
                for ($k = $z1; $k <= $z2; $k++) {
                    $sum += $this->cube[$i][$j][$k];
                }
            }
        }
        return $sum;
    }

    public function getM()
    {
        return $this->m;
    }

    public function getCube()
    {
        return $this->cube;
    }

    public function getN()
    {
        return $this->n;
    }
}
