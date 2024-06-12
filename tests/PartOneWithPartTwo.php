<?php

require 'vendor/autoload.php';

use Facebook\WebDriver\Interactions\WebDriverActions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

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
        $desired_capabilities->setCapability('name', "ApplyingToJob");
        $desired_capabilities->setCapability('build', "LambdaTestSampleApp");
        $desired_capabilities->setCapability('network', true);
        $desired_capabilities->setCapability('visual', true);
        $desired_capabilities->setCapability('video', true);
        $desired_capabilities->setCapability('console', true);

        self::$driver = RemoteWebDriver::create($url, $desired_capabilities);

        self::$driver->get('http://www.bayt.com');

        // Scroll to the footer
        self::$driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');


        $aboutUsLink = self::$driver->findElement(WebDriverBy::linkText('Careers'));
        $aboutUsLink->click();

        self::$driver->manage()->timeouts()->implicitlyWait(10);
        $jobLink = self::$driver->findElement(WebDriverBy::cssSelector('.card-footer a.btn.view-jb-btn.capitalize'));
        $jobLink->click();

        self::$driver->manage()->timeouts()->implicitlyWait(10);

        $applyNowButton = self::$driver->findElement(WebDriverBy::cssSelector('.job-footer a.btn'));
        $applyNowButton->click();

        $CreateAccount = self::$driver->findElement(WebDriverBy::linkText('Create a new account'));
        $CreateAccount->click();
        // Upload resume
        // try {
        // 	$uploadField = self::$driver->findElement(WebDriverBy::id('triggerUploadField'));
        // 	$uploadField->click();

        // 	// Wait for the file upload dialog to appear
        // 	$fileDialog = self::$driver->switchTo()->activeElement();
        // 	$fileDialog->sendKeys('C:\xampp\htdocs\Php-Selenium\tests\Sami_Atanah_Li_FullStack.pdf');

        // 	// Wait for the file upload process to complete (adjust the sleep time as needed)
        // 	sleep(5);

        // 	// Continue with other actions...
        // } catch (Exception $e) {
        // 	echo "Exception: " . $e->getMessage();
        // }

        //First Name
        $FirstNameField = self::$driver->findElement(WebDriverBy::name('first_name'));
        $FirstNameField->sendKeys('TESTING'); // Replace with the actual password

        //Last Name
        $LastNameField = self::$driver->findElement(WebDriverBy::name('last_name'));
        $LastNameField->sendKeys('ASSIGNMENT'); // Replace with the actual password

        //Email
        $email = self::$driver->findElement(WebDriverBy::name('email'));
        $email->sendKeys('sami.ramiz.24.1@gmail.com'); // Replace with the actual password

        // Enter password
        $passwordField = self::$driver->findElement(WebDriverBy::name('password'));
        $passwordField->sendKeys('G@8FoA&PC3Jcn@Xe!Fr3'); // Replace with the actual password

        sleep(3);
        try {
            // Check if the error message appears
            $errorMessage = self::$driver->findElement(WebDriverBy::id('err-email'));
            if ($errorMessage) {

                $email = self::$driver->findElement(WebDriverBy::name('email'));
                $email->clear();
                $email->sendKeys('user' . time() . '@example.com');

            }
        } catch (Exception $e) {
            echo "Error message not found or other exception: " . $e->getMessage();
        }

        // Select birthdate
        $birthDay = self::$driver->findElement(WebDriverBy::id('id-birthdate_day'));
        $birthDay->sendKeys('24');

        $birthMonth = self::$driver->findElement(WebDriverBy::id('id-birthdate_month'));
        $birthMonth->sendKeys('January');

        $birthYear = self::$driver->findElement(WebDriverBy::id('id-birthdate_year'));
        $birthYear->sendKeys('1998');

        self::$driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');
        // Click the radio button
        $radioButton = self::$driver->findElement(WebDriverBy::cssSelector('input[type="radio"][name="internal_employee_check"][value="0"]'));
        $radioButton->click();

        // Select an option from the dropdown menu
        $advMedium = self::$driver->findElement(WebDriverBy::name('adv_medium'));
        $advMedium->sendKeys('Online Banner');


        $termsCheck = self::$driver->findElement(WebDriverBy::name('terms'));
        $termsCheck->click();
        $createAccountButton = self::$driver->findElement(WebDriverBy::cssSelector('.action-buttons button'));

        $createAccountButton->click();

        sleep(10);


        $closeButton = self::$driver->findElement(
            WebDriverBy::cssSelector('.modalcloseimg.modalClose')
        );
        $closeButton->click();
        sleep(5);


        try {
            $errorMessage = self::$driver->findElement(WebDriverBy::cssSelector('.info.account_activation_banner'));
            if ($errorMessage) {
                $profileIcon = self::$driver->findElement(WebDriverBy::cssSelector('.r.bcc_top_action_loggedin.pos-rel.cursor_p'));

                $actions = new WebDriverActions(self::$driver);
                $actions->moveToElement($profileIcon)->perform();

                self::$driver->wait()->until(
                    WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('.logged_hover_panel'))
                );

                $accountSettingsLink = self::$driver->findElement(WebDriverBy::linkText('Account Settings'));
                $accountSettingsLink->click();

                self::$driver->executeScript('window.scrollTo(0, document.body.scrollHeight);');


                $deleteAccountFieldset = self::$driver->findElement(WebDriverBy::cssSelector('fieldset.delete-account'));

                $deleteAccountLink = $deleteAccountFieldset->findElement(WebDriverBy::cssSelector('a'));
                $deleteAccountLink->click();
                sleep(4);

                $deleteAccountButton = self::$driver->findElement(WebDriverBy::cssSelector('button[type="submit"][onclick*="ConfirmDelete"]'));
                $deleteAccountButton->click();

                $alert = self::$driver->switchTo()->alert();
                $alert->accept();
                sleep(2);
                self::$driver->quit();
                echo "Done" . "\n";
            }
        } catch (Exception $e) {
            echo "Error message not found or other exception: " . $e->getMessage();
        }
    }
}

$lambdaTest = new LambdaTest();
$lambdaTest->testAdd();

?>