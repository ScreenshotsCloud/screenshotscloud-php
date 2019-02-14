<?php
require(__DIR__ . '/../src/ScreenshotsCloud.php');
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

	public function testDoesntOmitFalseValues()
    {
        $this->assertStringEndsWith(
            '&full_page=0',
            ScreenshotsCloud::screenshotUrl(['url' => 'https://api.screenshots.cloud/', 'full_page' => false], 'API_KEY', 'API_SECRET')
        );
	}

	public function testConvertsTrueValues()
    {
        $this->assertStringEndsWith(
            '&full_page=1',
            ScreenshotsCloud::screenshotUrl(['url' => 'https://api.screenshots.cloud/', 'full_page' => true], 'API_KEY', 'API_SECRET')
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
		
		$this->assertStringEndsWith(
            'url=api.screenshots.cloud',
            ScreenshotsCloud::screenshotUrl(['url' => 'api.screenshots.cloud'], 'API_KEY', 'API_SECRET')
        );
    }
}
