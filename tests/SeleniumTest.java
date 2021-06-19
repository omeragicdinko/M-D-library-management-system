//YOU WILL NEED SELENIUM SETUP TO RUN THESE TESTS
package test;

import static org.junit.Assert.assertEquals;

import org.junit.jupiter.api.*;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.Select;

class SeleniumTest {
	
	private static WebDriver webDriver;
	private static String libraryUrl;
	private static String booksUrl;
	private static String loginUrl;
	private static String employeesUrl;
	
	@BeforeAll
	static void setUp() {
		System.setProperty("webdriver.chrome.driver", "C:\\Users\\Mirza\\Documents\\chromedriver\\chromedriver.exe");
		webDriver = new ChromeDriver();
		loginUrl = "https://m-d-library-management-system.herokuapp.com/login.html";
		libraryUrl = "https://m-d-library-management-system.herokuapp.com/index.html#libraries";
		employeesUrl = "https://m-d-library-management-system.herokuapp.com/index.html#employees";
		booksUrl = "https://m-d-library-management-system.herokuapp.com/index.html#books";
	}
	@Test
	void loginFormValidation() throws InterruptedException {
		webDriver.get(loginUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		//entering not valid email
		WebElement email = webDriver.findElement(By.name("email"));
		email.sendKeys("mkwwww");
		
		WebElement password = webDriver.findElement(By.name("password"));
		password.sendKeys("1234");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		WebElement emailError = webDriver.findElement(By.id("email-error"));
		assertEquals("Please enter a valid email address.", emailError.getText());
		Thread.sleep(1500);
		
		//entering not used credentials
		email.clear();
		password.clear();
		email.sendKeys("mkwwww@gmail.com");
		password.sendKeys("1234");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		WebElement userNotFoundMessage = webDriver.findElement(By.xpath("/html/body/div[2]/div/div"));
		assertEquals("User not found", userNotFoundMessage.getText());
		
		//entering wrong password
		email.clear();
		password.clear();
		email.sendKeys("mk@gmail.com");
		password.sendKeys("1");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		WebElement wrongPassword = webDriver.findElement(By.xpath("/html/body/div[2]/div/div"));
		assertEquals("Password is not correct", wrongPassword.getText());
		
		//empty fields
		email.clear();
		password.clear();
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		WebElement emptyFields = webDriver.findElement(By.id("password-error"));
		assertEquals("This field is required.", emptyFields.getText());
		WebElement emptyFields1 = webDriver.findElement(By.id("email-error"));
		assertEquals("This field is required.", emptyFields1.getText());
		
		//entering correct data
		email.sendKeys("mk@gmail.com");
		password.sendKeys("123123");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		String currentUrl = webDriver.getCurrentUrl();
		assertEquals("https://m-d-library-management-system.herokuapp.com/index.html#libraries", currentUrl);
	}
	
	@Test
	void newLibraryTest() throws InterruptedException {
		webDriver.get(loginUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		WebElement email = webDriver.findElement(By.name("email"));
		WebElement password = webDriver.findElement(By.name("password"));
		email.sendKeys("mk@gmail.com");
		password.sendKeys("123123");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		webDriver.get(libraryUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		WebElement name = webDriver.findElement(By.name("name"));
		WebElement workingHours = webDriver.findElement(By.name("working-hours"));
		WebElement phoneNumber = webDriver.findElement(By.name("phone-number"));
		WebElement address = webDriver.findElement(By.name("address"));
		WebElement city = webDriver.findElement(By.name("city"));
		WebElement location = webDriver.findElement(By.name("location"));
		
		webDriver.findElement(By.xpath("/html/body/main/section[5]/div[1]/button")).click();
		Thread.sleep(1500);
		
		//empty fields
		location.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		WebElement emptyFields = webDriver.findElement(By.id("location-error"));
		assertEquals("This field is required.", emptyFields.getText());
		WebElement emptyFields1 = webDriver.findElement(By.id("name-error"));
		assertEquals("This field is required.", emptyFields1.getText());
		WebElement emptyFields3 = webDriver.findElement(By.id("working-hours-error"));
		assertEquals("This field is required.", emptyFields3.getText());
		WebElement emptyFields4 = webDriver.findElement(By.id("address-error"));
		assertEquals("This field is required.", emptyFields4.getText());
		
		//entering valid information
		name.sendKeys("Biblioteka - odjeljenje 8");
		workingHours.sendKeys("09:00-16:30");
		phoneNumber.sendKeys("06128978");
		address.sendKeys("Trg heroja 22");
		city.sendKeys("Bihac");
		location.sendKeys("https://www.google.com/maps/place/Biblioteka+-+odjeljenje+14/@43.8418391,18.3456328,15z/data=!4m2!3m1!1s0x0:0x422f0845330b9b70?sa=X&ved=2ahUKEwjYr_fL0NPwAhVNOBoKHW9KAbAQ_BIwDXoECCsQAw");
		location.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		WebElement toastrMessage = webDriver.findElement(By.xpath("/html/body/div/div/div"));
		assertEquals("You have added a new library", toastrMessage.getText());
		Thread.sleep(800);
	}
	
	@Test
	void employeeFormTest() throws InterruptedException {
		webDriver.get(loginUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		WebElement email = webDriver.findElement(By.name("email"));
		WebElement password = webDriver.findElement(By.name("password"));
		email.sendKeys("mk@gmail.com");
		password.sendKeys("123123");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		webDriver.get(employeesUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		WebElement name = webDriver.findElement(By.xpath("/html/body/main/section[4]/div[4]/div/div/form/div[2]/div[2]/input"));
		WebElement address = webDriver.findElement(By.xpath("/html/body/main/section[4]/div[4]/div/div/form/div[2]/div[5]/input"));
		WebElement salary = webDriver.findElement(By.xpath("/html/body/main/section[4]/div[4]/div/div/form/div[2]/div[8]/input"));
		WebElement password1 = webDriver.findElement(By.xpath("/html/body/main/section[4]/div[4]/div/div/form/div[2]/div[10]/input"));
		
		webDriver.findElement(By.xpath("/html/body/main/section[4]/div[2]/table/tbody/tr[1]/td[10]/button")).click();
		Thread.sleep(1500);
		
		//empty fields
		name.clear();
		salary.clear();
		address.clear();
		password1.clear();
		Thread.sleep(800);
		password1.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		WebElement emptyFields = webDriver.findElement(By.id("salary-error"));
		assertEquals("This field is required.", emptyFields.getText());
		WebElement emptyFields1 = webDriver.findElement(By.id("name-error"));
		assertEquals("This field is required.", emptyFields1.getText());
		WebElement emptyFields3 = webDriver.findElement(By.id("password-error"));
		assertEquals("This field is required.", emptyFields3.getText());
		WebElement emptyFields4 = webDriver.findElement(By.id("street-address-error"));
		assertEquals("This field is required.", emptyFields4.getText());	
		
		//updating fields
		name.sendKeys("Alma");
		salary.sendKeys("1205");
		address.sendKeys("Ruzevik 1");
		password1.sendKeys("123123");
		Thread.sleep(800);
		password1.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		WebElement toastrMessage = webDriver.findElement(By.xpath("/html/body/div/div"));
		assertEquals("You have updated a employee", toastrMessage.getText());
		Thread.sleep(800);
		
		//deleting employee
		webDriver.findElement(By.xpath("/html/body/main/section[4]/div[2]/table/tbody/tr[7]/td[11]/button")).click();
		Thread.sleep(1500);
		WebElement deleteMessage = webDriver.findElement(By.xpath("/html/body/div/div/div"));
		assertEquals("Deleted", deleteMessage.getText());
		Thread.sleep(800);
	}
	
	@Test
	void addNewBookFormTest() throws InterruptedException {
		webDriver.get(loginUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		WebElement email = webDriver.findElement(By.name("email"));
		WebElement password = webDriver.findElement(By.name("password"));
		email.sendKeys("mk@gmail.com");
		password.sendKeys("123123");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(1500);
		
		webDriver.get(booksUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		WebElement name = webDriver.findElement(By.name("name"));
		WebElement author = webDriver.findElement(By.xpath("/html/body/main/section[1]/div[3]/div/div/form/div[2]/div[2]/input"));
		WebElement genre = webDriver.findElement(By.name("genre"));
		WebElement yearOfPub = webDriver.findElement(By.name("year-of-publishing"));
		Select libID = new Select(webDriver.findElement(By.name("library-id")));
		WebElement addBtn = webDriver.findElement(By.xpath("/html/body/main/section[1]/div[3]/div/div/form/div[3]/button[2]"));

		webDriver.findElement(By.xpath("/html/body/main/section[1]/div[1]/button")).click();
		Thread.sleep(1500);
		
		//empty fields
		addBtn.click();
		Thread.sleep(1500);
		
		WebElement emptyFields = webDriver.findElement(By.id("year-of-publishing-error"));
		assertEquals("This field is required.", emptyFields.getText());
		WebElement emptyFields1 = webDriver.findElement(By.id("name-error"));
		assertEquals("This field is required.", emptyFields1.getText());
		WebElement emptyFields3 = webDriver.findElement(By.id("author-error"));
		assertEquals("This field is required.", emptyFields3.getText());
		WebElement emptyFields4 = webDriver.findElement(By.id("genre-error"));
		assertEquals("This field is required.", emptyFields4.getText());	
		
		//adding new book
		name.sendKeys("New book");
		Thread.sleep(1500);
		author.sendKeys("New author");
		Thread.sleep(1500);
		genre.sendKeys("Book genre");
		Thread.sleep(1500);
		yearOfPub.sendKeys("2020");
		Thread.sleep(1500);
		libID.selectByVisibleText("Biblioteka - odjeljenje 8");
		addBtn.click();
		Thread.sleep(1500);
		
		WebElement toastrMessage = webDriver.findElement(By.xpath("/html/body/div/div/div"));
		assertEquals("You have added a new book", toastrMessage.getText());
		Thread.sleep(800);
		
		//deleting employee
		webDriver.findElement(By.xpath("/html/body/main/section[1]/div[2]/table/tbody/tr[3]/td[12]/button")).click();
		Thread.sleep(1500);
		WebElement deleteMessage = webDriver.findElement(By.xpath("/html/body/div/div/div"));
		assertEquals("Deleted", deleteMessage.getText());
		Thread.sleep(800);	
	}
	@Test
	void logoutTest() throws InterruptedException {
		webDriver.get(loginUrl);
		webDriver.manage().window().fullscreen();
		Thread.sleep(800);
		
		WebElement email = webDriver.findElement(By.name("email"));
		WebElement password = webDriver.findElement(By.name("password"));
		email.sendKeys("mk@gmail.com");
		password.sendKeys("123123");
		password.sendKeys(Keys.ENTER);
		Thread.sleep(4000);
		
		webDriver.manage().window().fullscreen();
		Thread.sleep(3000);
		webDriver.findElement(By.id("nav-logout")).click();
		webDriver.manage().window().fullscreen();
		Thread.sleep(3000);
		
		String currentUrl = webDriver.getCurrentUrl();
		assertEquals("https://m-d-library-management-system.herokuapp.com/login.html", currentUrl);
		Thread.sleep(800);	
	}
	
	@AfterAll
	static void tearDown() {
		webDriver.close();
	}

}
