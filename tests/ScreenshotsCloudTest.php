<?php
use PHPUnit\Framework\TestCase;
use ScreenshotsCloud\ScreenshotsCloud;

/**
 * @covers ScreenshotsCloud
 */
final class ScreenshotsCloudTest extends TestCase
{
    public function testCanBeCreatedFromKeys()
    {
        $this->assertStringStartsWith(
            'https://api.screenshots.cloud/',
            ScreenshotsCloud::screenshotUrl(['url' => 'https://api.screenshots.cloud/'], 'API_KEY', 'API_SECRET')
        );
    }

	public function testCannotBeCreatedFromMissingKeys()
    {
        $this->expectException(Exception::class);
        $this->assertStringStartsWith(
			'https://api.screenshots.cloud/',
			ScreenshotsCloud::screenshotUrl(['url' => 'https://api.screenshots.cloud/'])
		);
    }

	public function testCanSendParameters()
    {
        $this->assertStringEndsWith(
            '&width=800',
            ScreenshotsCloud::screenshotUrl(['url' => 'https://api.screenshots.cloud/', 'width' => 800], 'API_KEY', 'API_SECRET')
        );
    }
}
