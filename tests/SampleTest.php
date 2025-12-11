<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    #[Test]
    public function example(): void
    {
        $this->assertTrue(true);
    }
}
