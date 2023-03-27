#! /usr/bin/python3

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.options import Options

options = Options()
options.headless = True
# chromeOptions.binary_location = "/Applications/Google Chrome.app/Contents/MacOS/Google Chrome"
options.binary_location = "/usr/bin/google-chrome-stable"

options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
# chromeOptions.addArguments("--start-maximized");
# browser = webdriver.Chrome(executable_path="./drivers/chromedriver", options=chromeOptions)
driver = webdriver.Chrome(executable_path="/home/da/pyproject/chrome-headless/drivers/chromedriver", options=options)


# chrome_driver_binary = "/usr/local/bin/chromedriver"
# driver = webdriver.Chrome(chrome_options=options)
# driver = webdriver.Chrome(executable_path="/home/da/chromedriver", options=chromeOptions)
# driver = webdriver.Chrome(options=chromeOptions)
# browser = webdriver.Chrome()
# browser.get("http://linuxhint.com")
# print("Title: %s" % browser.title)
# browser.quit()

url = "https://invest-tracing.com"
# url = "https://graspgold.com"
# url = "https://hyips.bz"
# driver = webdriver.Chrome()
# driver.get(args.url)
# driver.get(kak[0])
driver.get(url)
a = driver.page_source
# driver.set_window_size(1024, 600)
driver.set_window_size(1366, 768)
# driver.set_window_size(1920, 1080)
# driver.set_window_size(1920, 1080)
driver.maximize_window()

driver.save_screenshot("/home/da/pyproject/chrome-headless/huy.png")
driver.close()

try:
    with open("/home/da/pyproject/chrome-headless/huy.htm", "w") as fp:
    # with open("/opt/lampp/htdocs/tihuy/py/xxx2.htm", "w") as fp:
        fp.write(a)
except IOError as e:
    print("error writing to file")
