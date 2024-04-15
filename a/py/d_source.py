from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb

monitor = "https://hyipbusket.com/"
display = Xvfb()
display.start()
options = Options()
options.headless = True
options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
driver = webdriver.Chrome(options=options)
driver.get(monitor)
source = driver.page_source
driver.set_window_size(1366, 768)
driver.maximize_window()
driver.save_screenshot("/opt/lampp/htdocs/hyip/py/pic.png")

try:
    with open("source.htm", "w") as fp:
        fp.write(source)
except IOError as e:
    print("error writing to file")

driver.close()
display.stop()

huy = None
