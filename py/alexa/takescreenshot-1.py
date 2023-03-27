from selenium.common.exceptions import TimeoutException
from selenium.webdriver.chrome.options import Options
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from xvfbwrapper import Xvfb  # stopped working

# display = Xvfb()
# display.start()
options = Options()
options.headless = True
options.add_argument("hide-scrollbars")
options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
# driver = webdriver.Chrome(options=options, executable_path="/var/www/html/py/chromedriver") executable_path has been deprecated, please pass in a Service object
driver = webdriver.Chrome(options=options, service=Service(ChromeDriverManager().install()))

url = "http://localhost/coinzilla-1/test/calendar-template.html"

try:
    # driver.set_window_size(1366, 768)
    driver.set_window_size(850, 10800)  # for calendar-mobile.html
    # driver.set_window_size(3480, 3010)  # for calendar-tb.html
    # driver.set_window_size(1000, 100000)
    driver.maximize_window()
    driver.set_script_timeout(30)
    driver.get(url)
    source = driver.page_source
    # issue = driver.get_issue_message()
    # log = driver.get_log(ConnectionError)
    # log1 = driver.get_log(Exception)
    # ga = driver.get_network_conditions()
    with open("/var/www/html/py/alexa/selenium/da.htm", "w") as fp:
        fp.write(source)
    # driver.save_screenshot("/var/www/html/py/alexa/pics-sel/calendar-mobile.png")
    driver.save_screenshot("/var/www/html/py/alexa/pics-sel/kak.png")
except TimeoutException:
    source = "xxx"
pass

driver.close()
# display.stop()
