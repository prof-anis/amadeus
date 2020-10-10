<?php



use PHPUnit\Framework\TestCase;

class ReloadlyTest extends TestCase
{
    public function setUp(): void
    {
        $this->reloadly = new Busybrain\Reloadly\Reloadly("client_id","secrete_id");
    }

    /**
     * @test
     */
    public function test_will_throw_exception_when_invalid_api_is_called()
    {
        $this->expectException(\Busybrain\Reloadly\Exceptions\BadMethodCallException::class);
        $this->reloadly->thisApiDoesNotExist();
    }
}
