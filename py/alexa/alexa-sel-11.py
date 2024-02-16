from selenium.common.exceptions import TimeoutException
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb

# display = Xvfb()
# display.start()
options = Options()
options.headless = True
options.add_argument("hide-scrollbars")
options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
driver = webdriver.Chrome(options=options, executable_path="/py/oldchromedriver/2/chromedriver")
url = "http://localhost/coinzilla-1/test/calendar-mobile-1-1.html"
# url = "https://www.gnu.org/software/wget/manual/wget.html#Download-Options"

try:
    # driver.set_window_size(1366, 768)
    # driver.set_window_size(1200, 13700)
    driver.set_window_size(800, 10200)
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
    driver.save_screenshot("/var/www/html/py/alexa/pics-sel/da.png")
except TimeoutException:
    source = "xxx"
pass

driver.close()
# display.stop()
