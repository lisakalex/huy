from selenium import webdriver
from bs4 import BeautifulSoup
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb
import time
import random
from pathlib import Path
from selenium.common.exceptions import TimeoutException
# from Hyip import Hyip
# import hyip
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.common.exceptions import TimeoutException

# hyip = hyip()
#
# display = Xvfb()
# display.start()
options = Options()
# options.headless = True
options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
options.add_argument("ignore-certificate-errors")
options.add_argument("--no-sandbox")
options.add_argument("--disable-blink-features=AutomationControlled")
driver = webdriver.Chrome(options=options)
# driver.get('https://fairmonitor.com')
driver.get('https://hyipbusket.com')
# delay = 10
# myElem = WebDriverWait(driver, delay).until(EC.presence_of_element_located((By.CLASS_NAME, 'wrapper')))
# time.sleep(5)
source = driver.page_source

driver.close()
# display.stop()
# def __source(monitor):
#     display = Xvfb()
#     display.start()
#     options = Options()
#     options.headless = True
#     options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
#     options.add_argument("ignore-certificate-errors")
#     options.add_argument("--no-sandbox")
#     options.add_argument("--disable-blink-features=AutomationControlled")
#     driver = webdriver.Chrome(options=options)
#     try:
#         driver.get(monitor)
#         source = driver.page_source
#     except TimeoutException:
#         source = "xxx"
#         pass
#
#     driver.close()
#     display.stop()
#     return source
#     # return BeautifulSoup(source, features="html.parser")
#
#
# # kak = __source('https://www.hyipexplorer.com')
# kak = __source('https://fairmonitor.com/')
huy = None
