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


# service = Service('/home/al/.local/bin/chromedriver')
# service.start()
# driver = webdriver.Remote(service.service_url)
# driver.get('http://www.google.com/')
# time.sleep(5) # Let the user actually see something!
# driver.quit()

cnx = mysql.connector.connect(host='localhost', user='al', passwd='Zaichik1.&', database='hyip')
cursor = cnx.cursor()
query = "SELECT monitor FROM hyip.monitor"
cursor.execute(query)
monitors = cursor.fetchall()
for m in monitors:
    # service = Service('/home/al/.local/bin/chromedriver')
    # service.start()
    # driver = webdriver.Remote(service.service_url)
    # display = Xvfb()
    # display.start()
    options = Options()
    # options.headless = True
    service = Service(executable_path='./chromedriver')
    options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    options.add_argument("hide-scrollbars")
    driver = webdriver.Chrome(service=service, options=options)
    try:
        driver.get(m[0])
    except Exception as e:
        print(e)
        with open('kak/error.txt', "a") as file:
            file.write(m[0] + ' ' + e + '\n')
    pass

    source = driver.page_source
    driver.set_window_size(2560, 1600)
    driver.maximize_window()
    domain = urlparse(m[0]).netloc
    driver.save_screenshot('kak/' + domain + '.png')
    # driver.save_screenshot("/var/www/html/internetspeed/pic/" + site_name + ".png")
    driver.close()
    # display.stop()
