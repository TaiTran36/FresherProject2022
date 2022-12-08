<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_equal()
    {
        $expected = "aaa"; 
        $actual = "aaa b"; 

        $this->assertEquals( 
            $expected, 
            $actual, 
            "actual value is not equals to expected"
        ); 
    }
}
