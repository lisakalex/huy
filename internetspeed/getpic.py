from selenium import webdriver
from bs4 import BeautifulSoup
# import mysql.connector
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb
import time
from selenium.webdriver.chrome.service import Service


# service = Service('/home/al/.local/bin/chromedriver')
# service.start()
# driver = webdriver.Remote(service.service_url)
# driver.get('http://www.google.com/')
# time.sleep(5) # Let the user actually see something!
# driver.quit()

def get_picture(monitor, site_name):
    # service = Service('/home/al/.local/bin/chromedriver')
    # service.start()
    # driver = webdriver.Remote(service.service_url)
    display = Xvfb()
    display.start()
    options = Options()
    options.headless = True
    options.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    options.add_argument("hide-scrollbars")
    driver = webdriver.Chrome(options=options)
    driver.get(monitor)
    source = driver.page_source
    driver.set_window_size(1366, 768)
    driver.maximize_window()
    driver.save_screenshot("/home/al/Pictures/www.hyipnews.com.png")
    # driver.save_screenshot("/var/www/html/internetspeed/pic/" + site_name + ".png")
    driver.close()
    display.stop()
    # return BeautifulSoup(source, features="html.parser")


# get_picture("https://www.allhyipmonitors.com/", "allhyipmonitorscom")
get_picture("https://opensource.com/", "depo2")
# get_picture("https://depositcoin.net/", "ggg2")
