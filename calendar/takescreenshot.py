from selenium.common.exceptions import TimeoutException
from selenium.webdriver.chrome.options import Options
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

options = Options()
options.headless = True
options.add_argument("hide-scrollbars")
options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
driver = webdriver.Chrome(options=options, service=Service(ChromeDriverManager().install()))

url = "http://localhost/calendar/calendar-mobile-2024.html"
# url = "http://localhost/calendar/calendar-2024.html"
# huy
try:
    driver.set_window_size(850, 10800)  # for calendar-mobile.html
    # driver.set_window_size(3480, 3010)  # for calendar.html
    driver.maximize_window()
    driver.set_script_timeout(30)
    driver.get(url)
    source = driver.page_source
    # driver.save_screenshot("/var/www/html/calendar/calendar-mobile-2024.png")
    driver.save_screenshot("/var/www/html/calendar/calendar-2024.png")
except TimeoutException:
    source = "xxx"
pass

driver.close()
