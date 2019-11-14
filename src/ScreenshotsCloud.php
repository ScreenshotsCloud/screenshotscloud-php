<?php

namespace ScreenshotsCloud;

class ScreenshotsCloud {
	public static function screenshotUrl($options = null, $apiKey = null, $apiSecret = null) {
		if(!isset($options['url'])) {
			throw new \Exception("Url not supplied to ScreenshotsCloud function");
		}

		if(!$apiKey && defined('SCREENSHOTSCLOUD_KEY')) {
			$apiKey = SCREENSHOTSCLOUD_KEY;
		}

		if(!$apiKey) {
			throw new \Exception("Api Key not supplied to ScreenshotsCloud function", E_USER_ERROR);
		}

		if(!$apiSecret && defined('SCREENSHOTSCLOUD_SECRET')) {
			$apiSecret = SCREENSHOTSCLOUD_SECRET;
		}

		if(!$apiSecret) {
			throw new \Exception("Api Secret not supplied to ScreenshotsCloud function", E_USER_ERROR);
		}

		$domain = defined('SCREENSHOTSCLOUD_DOMAIN')?SCREENSHOTSCLOUD_DOMAIN:'https://api.screenshots.cloud';

		$queryString = http_build_query($options);

		$token = hash_hmac("sha1", $queryString, $apiSecret);

		return "$domain/v1/screenshot/$apiKey/$token?$queryString";
	}
}


