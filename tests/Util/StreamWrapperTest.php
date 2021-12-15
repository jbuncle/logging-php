<?php declare(strict_types=1);
namespace JBuncle\Logging\Util;

use \PHPUnit\Framework\TestCase;

class StreamWrapperTest extends TestCase {

    public function testWrite(): void {
        $filename = tempnam(sys_get_temp_dir(), 'logging-tests-');

        $text = "Test text";

        $streamWrapper = new StreamWrapper($filename);

        $this->assertFalse($streamWrapper->isOpen());

        $streamWrapper->open('w');
        $streamWrapper->write($text);

        $this->assertTrue($streamWrapper->isOpen());

        $streamWrapper->close();

        $this->assertFalse($streamWrapper->isOpen());
        $this->assertEquals($text, file_get_contents($filename));

        // Cleanup
        unlink($filename);
    }

    public function testReopen(): void {
        $filename = tempnam(sys_get_temp_dir(), 'logging-tests-');

        $text = "Test text";

        $streamWrapper = new StreamWrapper($filename);

        $streamWrapper->open('w');
        $streamWrapper->write($text);
        $streamWrapper->open('a');
        $this->assertTrue($streamWrapper->isOpen());
        $streamWrapper->write($text);

        $this->assertEquals($text . $text, file_get_contents($filename));

        // Cleanup
        unlink($filename);
    }

    public function testErrorOpening(): void {
        $filename = '/path/that/doesnt/exists';

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("fopen($filename): failed to open stream: No such file or directory");

        $streamWrapper = new StreamWrapper($filename);

        $streamWrapper->open('w');

        // Cleanup
        unlink($filename);
    }

}
