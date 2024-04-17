from selenium.common.exceptions import TimeoutException
from selenium.webdriver.chrome.options import Options
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
# from webdriver_manager.chrome import ChromeDriverManager

options = Options()
options.headless = True
options.add_argument("hide-scrollbars")
options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
# driver = webdriver.Chrome(options=options, service=Service(ChromeDriverManager().install()))
# service = Service(executable_path='/var/www/html/chromedriver')
service = Service(executable_path='/var/www/huy.com/chromedriver')
driver = webdriver.Chrome(service=service, options=options)

try:
    # driver.set_window_size(850, 10800)  # for calendar-mobile.html
    # driver.set_window_size(850, 9800)  # for calendar-mobile.html
    driver.set_window_size(3480, 3010)  # for calendar.html
    driver.maximize_window()
    driver.set_script_timeout(30)
    # driver.get("http://localhost/calendar/calendar-mobile-2024.html")
    driver.get("http://hindex-local.uk/calendar-2025.html")
    source = driver.page_source
    # driver.save_screenshot("/var/www/html/calendar/images/calendar-mobile-2024.png")
    driver.save_screenshot("calendar-2025.png")
except TimeoutException:
    source = "xxx"
pass

driver.close()
