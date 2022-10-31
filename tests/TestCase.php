<?php

namespace Tests;

use Exception;
use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected Generator $faker;


    /**
     * @param $key
     * @return Generator
     * @throws Exception
     */
    public function __get($key)
    {
        if ($key === 'faker')
            return $this->faker;

        throw new Exception('Unknown Key Requested');
    }
}
