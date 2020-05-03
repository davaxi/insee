<?php

use Davaxi\Insee as Insee;

class InseeTest extends InseePHPUnit
{
    /**
     * @var Insee
     */
    protected $insee;

    protected function setUp()
    {
        parent::setUp();
        $this->insee = new Insee();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->insee = null;
    }

    public function testClass()
    {
        $this->assertTrue(true);
    }
}
