<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // The test suite exercises views, not the compiled front-end assets.
        // A fresh checkout has no public/build manifest, so don't require one.
        $this->withoutVite();
    }
}
