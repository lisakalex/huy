#!/home/al/.venv/bin/python3.10
from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.common import TimeoutException
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb
import time
from selenium.webdriver.chrome.service import Service
from urllib.parse import urlparse
import requests
import pycurl
import certifi
from io import BytesIO
import urllib3

cnx = mysql.connector.connect(host='localhost', user='al', passwd='Zaichik1.&', database='hyip')
cursor = cnx.cursor()
query = "SELECT monitor FROM hyip.monitor where alexa is null"
# query = "select * from monitor where alexa is null"
cursor.execute(query)
monitors = cursor.fetchall()
source = None
testdir = 'testdir/'
# testdir = ''

for m in monitors:
    monitor = m[0]
    # monitor = 'https://hp-industry.com'
    options = Options()
    options.headless = True
    service = Service(executable_path='./chromedriver')
    options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    options.add_argument("hide-scrollbars")
    driver = webdriver.Chrome(service=service, options=options)
    try:
        driver.get(monitor)
    except Exception as e:
        print(e)
        with open('monitors/error/selenium-error.txt', "a") as file:
            file.write(monitor + ' ' + str(e) + '\n')
        pass

    driver.set_window_size(2560, 1600)
    driver.maximize_window()
    domain = urlparse(monitor).netloc
    driver.save_screenshot('kak/' + domain + '.png')
    if driver.page_source is not None:
        with open("monitors/selenium/" + testdir + domain + ".htm", "w") as fp:
            fp.write(driver.page_source)

    driver.close()

    # requests
    headers = {"user-agent": 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
    source = None
    try:
        source = requests.get(monitor, headers=headers, timeout=None)
    except Exception as e:
        print(e)
        with open('monitors/error/requests-error.txt', "a") as file:
            file.write(monitor + ' ' + str(e) + '\n')

        pass

    if source is not None:
        with open("monitors/requests/" + testdir + domain + ".htm", "w") as fp:
            fp.write(source.text)

    # curl
    buffer = BytesIO()
    c = pycurl.Curl()
    c.setopt(c.URL, monitor)
    c.setopt(c.WRITEDATA, buffer)
    c.setopt(c.CAINFO, certifi.where())

    try:
        c.perform()
    except Exception as e:
        print(e)
        with open('monitors/error/curl-error.txt', "a") as file:
            file.write(monitor + ' ' + str(e) + '\n')
        pass

    c.close()

    body = buffer.getvalue()
    source = body.decode('iso-8859-1')
    if source is not None:
        with open("monitors/curl/" + testdir + domain + ".htm", "w") as fp:
            fp.write(source)

    print(monitor)
