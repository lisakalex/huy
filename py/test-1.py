#!/usr/bin/env python
from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options

options = Options()
options.headless = True
options.binary_location = "/usr/bin/google-chrome-stable"

options.add_argument("start-maximized")
options.add_experimental_option("excludeSwitches", ["enable-automation"])
options.add_experimental_option('useAutomationExtension', False)
options.add_argument("--disable-blink-features=AutomationControlled")

options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
# driver = webdriver.Chrome(options=options)
driver = webdriver.Chrome(executable_path="/home/da/pyproject/chrome-headless/drivers/chromedriver", options=options)
url = "https://invest-tracing.com"
# url = "https://x-invest.net"
driver.get(url)
# s = driver.page_source
# driver.set_window_size(1024, 600)
driver.set_window_size(1366, 768)
# driver.set_window_size(1920, 1080)
# driver.set_window_size(1920, 1080)
driver.maximize_window()
# driver.save_screenshot("/opt/lampp/htdocs/tihuy/py/" + monitor + ".png")
# driver.save_screenshot("/opt/lampp/htdocs/tihuy/py/yyy.png")
# driver.save_screenshot("/home/da/pyproject/chrome-headless/" + monitor + ".png")
driver.save_screenshot("/home/da/pyproject/chrome-headless/yyy.png")
driver.close()
