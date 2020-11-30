
<?php

use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
require_once('vendor/autoload.php');

class UITest extends TestCase
{

    // chrome driver
    // https://www.lambdatest.com/blog/selenium-php-tutorial/
    protected $host = ' http://localhost:4444/wd/hub';
    protected $driver;

    public function setup(): void
    {

        $this->driver = RemoteWebDriver::create($this->host, DesiredCapabilities::chrome());
    }

    public function testLoginSuccess()
    {
        // browse to the website
        $this->driver->get('http://localhost');

        // enter fields
        $this->driver->findElement(WebDriverBy::id('email'))->sendKeys("user@example.com");
        $this->driver->findElement(WebDriverBy::id('password'))->sendKeys("password1234");

        // submit
        $buttonSubmit = $this->driver->findElement(WebDriverBy::id("submit"));
        $buttonSubmit->click();

        sleep(2);

        // assets matches
        $this->assertEquals('Dashboard | PHP Login and logout example with session', $this->driver->getTitle());

    
    }

    public function tearDown(): void
    {
      $this->driver->quit();
    }
}
