<?php

require 'vendor/autoload.php';

use Facebook\WebDriver\Interactions\WebDriverActions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverDimension;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;

$GLOBALS['LT_USERNAME'] = getenv('LT_USERNAME');
if (!$GLOBALS['LT_USERNAME'])
    $GLOBALS['LT_USERNAME'] = "sami.ramiz.24.1";

$GLOBALS['LT_ACCESS_KEY'] = getenv('LT_ACCESS_KEY');
if (!$GLOBALS['LT_ACCESS_KEY'])
    $GLOBALS['LT_ACCESS_KEY'] = "P8B9kzx9dj2UXXbrB8ydqS9xKay1kx2OY6rvz29mtix3YQf7Ex";

$GLOBALS['LT_BROWSER'] = getenv('LT_BROWSER');
if (!$GLOBALS['LT_BROWSER'])
    $GLOBALS['LT_BROWSER'] = "chrome";

$GLOBALS['LT_BROWSER_VERSION'] = getenv('LT_BROWSER_VERSION');
if (!$GLOBALS['LT_BROWSER_VERSION'])
    $GLOBALS['LT_BROWSER_VERSION'] = "latest";

$GLOBALS['LT_OPERATING_SYSTEM'] = getenv('LT_OPERATING_SYSTEM');
if (!$GLOBALS['LT_OPERATING_SYSTEM'])
    $GLOBALS['LT_OPERATING_SYSTEM'] = "win10";

class LambdaTest
{
    protected static $driver;

    public function testAdd()
    {
        $url = "https://" . $GLOBALS['LT_USERNAME'] . ":" . $GLOBALS['LT_ACCESS_KEY'] . "@hub.lambdatest.com/wd/hub";
        $desired_capabilities = DesiredCapabilities::chrome();
        $desired_capabilities->setCapability('platform', $GLOBALS['LT_OPERATING_SYSTEM']);
        $desired_capabilities->setCapability('name', "Search");
        $desired_capabilities->setCapability('build', "LambdaTestSampleApp");
        $desired_capabilities->setCapability('network', true);
        $desired_capabilities->setCapability('visual', true);
        $desired_capabilities->setCapability('video', true);
        $desired_capabilities->setCapability('console', true);

        self::$driver = RemoteWebDriver::create($url, $desired_capabilities);

        $dimension = new WebDriverDimension(375, 812);
        self::$driver->manage()->window()->setSize($dimension);


        self::$driver->get('http://www.bayt.com');

        $keyword = self::$driver->findElement(WebDriverBy::name('keyword'));
        $keyword->click();
        sleep(1);

        // $keyword1 = self::$driver->findElement(WebDriverBy::cssSelector('.input.is-small.u-expanded'));
        // $keyword1->sendKeys('Quality Assurance Engineer'); // Replace with the actual password

        // $searchInput = self::$driver->findElement(WebDriverBy::cssSelector('input[class="input is-small u-expanded"]'));

        $searchInput = self::$driver->findElement(WebDriverBy::cssSelector('input[data-search]'));

        $searchInput->sendKeys('Quality Assurance Engineer');

        $searchInput->sendKeys(WebDriverKeys::ENTER);

        $dropdownInput = self::$driver->findElement(WebDriverBy::id('search_country__r'));
        $dropdownInput->click();
        sleep(1);
        $uaeOption = self::$driver->findElement(WebDriverBy::xpath("//li[@data-text='United Arab Emirates']/a"));
        $uaeOption->sendKeys('United Arab Emirates'); // Replace with the actual password
        $uaeOption->click();

        $submitButton = self::$driver->findElement(WebDriverBy::cssSelector('.col.is-2 button.btn.is-xlarge.u-expanded'));
        $submitButton->click();


        $easyApplyDiv = self::$driver->findElement(WebDriverBy::cssSelector('.jb-easy-apply'));
        $easyApplyLabel = $easyApplyDiv->findElement(WebDriverBy::xpath("//label[contains(text(), 'Easy apply')]"));
        $easyApplyLabel->click();


        $applyLink_1 = self::$driver->findElement(WebDriverBy::id('applyLink_1'));
        $applyLink_1->click();

        sleep(4);
        self::$driver->quit();
    }
}

$lambdaTest = new LambdaTest();
$lambdaTest->testAdd();

?>