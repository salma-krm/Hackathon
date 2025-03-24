<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\CalculeService;
use Exception;

class CalculeServiceTest extends TestCase
{
    protected $calculeService;

    // Set up the service instance before each test
    protected function setUp(): void
    {
        parent::setUp();
        $this->calculeService = new CalculeService();
    }

    /**
     * Test the "some" method of CalculeService.
     *
     * @return void
     */
    public function testSuccessSome()
    {
        $result = $this->calculeService->some(3, 9);
        $this->assertEquals(12, $result);
    }

    /**
     * Test the "divide" method of CalculeService with valid inputs.
     *
     * @return void
     */
    public function testDivideFunctionSuccess()
    {
        $result = $this->calculeService->divide(2, 2);
        $this->assertEquals(1, $result);  // Fixed expected result to 1 (2 / 2 = 1)
    }

    /**
     * Test the "divide" method of CalculeService when dividing by zero.
     *
     * @return void
     */
    public function testDivideFunctionThrowsException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Division by zero is not allowed.');
        
        $this->calculeService->divide(2, 0);
    }
}
