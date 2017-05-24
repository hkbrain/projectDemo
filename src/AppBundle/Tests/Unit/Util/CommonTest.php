<?php

namespace Tests\AppBundle\Util;

use AppBundle\Util\common;
use PHPUnit\Framework\TestCase;

class CommonTest extends TestCase
{
    public function testgetDistancePass()
    {
        $common = new \AppBundle\Util\Common();
        $result = $common->getDistance(23.028345, 72.506703, 23.027884, 72.512147);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(0.55946039970634476, $result);
    }
    
}