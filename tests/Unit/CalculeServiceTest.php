<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\CalculeService;
use Exception;

class CalculeServiceTest extends TestCase
{
    /**
     * Test the "some" method of CalculeService.
     *
     * @return void
     */
    public function testSuccessSome()
    {
        $service = new CalculeService();

        $result = $service->some(3, 9);

        $this->assertEquals(12, $result);
    }

    /**
     * Test the "divide" method of CalculeService with valid inputs.
     *
     * @return void
     */
    public function testDivideFunctionSuccess()
    {
        $service = new CalculeService();

        $result = $service->divide(2, 2);

        $this->assertEquals(2, $result);
    }

    /**
     * Test the "divide" method of CalculeService when dividing by zero.
     *
     * @return void
     */
    public function testDivideFunctionThrowsException()
    {
        $service = new CalculeService();

        // Expect an exception to be thrown
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Division by zero is not allowed.');

        // Call the divide method with divisor as 0
        $service->divide(2, 0);
    }
}