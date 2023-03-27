#! /usr/bin/python3
from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options
from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb
import time
import random
from pathlib import Path
from Hyip import Hyip
from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options
import random
from pathlib import Path
from Hyip import Hyip
from xvfbwrapper import Xvfb
import time
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.common.exceptions import TimeoutException

cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
# cnx = mysql.connector.connect(host='localhost', user='tihuy', passwd='Zaichik1.&', database='tihuy')
cursor = cnx.cursor()
huy = "huylo"
da = 100
add_hyip = """INSERT INTO test (huy, da) VALUES (%s, %s)"""
# data_hyip = (huy, da)

data_hyip = [(huy, da),
             (huy, da),
             (huy, da)]

cursor.executemany(add_hyip, data_hyip)
emp_no = cursor.lastrowid
cnx.commit()
cursor.close()
cnx.close()

# ~~~
with open('source.htm', 'r', encoding="utf8") as reader:
    source = reader.read()

bs = BeautifulSoup(source, features="html.parser")


# ~~~
def asianhyip(self, monitor):
    bs = self.__source(monitor, 'asianhyip')
    hyip = []
    url = []
    status = []
    hyip_data = []

    for n in bs("div", class_="program"):
        hyip.append(n.find("div", class_="title2").get_text().capitalize())
        url.append(n.find("div", class_="title2").a.attrs['href'])
        s = n.find("div", class_="title2").next_sibling.next_sibling.text
        status.append(self.__get_status(s))

    for i in range(len(hyip)):
        h = (monitor, hyip[i], url[i], status[i])
        hyip_data.append(h)

    self.__store_hyip1(hyip_data)


cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
# cnx = mysql.connector.connect(host='localhost', user='tihuy', passwd='Zaichik1.&', database='tihuy')
cursor = cnx.cursor()
huy = "huylo"
da = 100
add_hyip = """INSERT INTO test (huy, da) VALUES (%s, %s)"""
# data_hyip = (huy, da)

data_hyip = [(huy, da),
             (huy, da),
             (huy, da)]

cursor.executemany(add_hyip, data_hyip)
emp_no = cursor.lastrowid
cnx.commit()
cursor.close()
cnx.close()

# ~~~
cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
cursor = cnx.cursor()
huy = "humknnnmm"
id = 10
update_monitor = "UPDATE test SET huy = %s WHERE id = %s"
data_monitor = (huy, id)

cursor.execute(update_monitor, data_monitor)
cnx.commit()
cursor.close()
cnx.close()

# cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
# cursor = cnx.cursor()
# huy = "humk"
# da = 5
# add_hyip = """INSERT INTO test (huy, da) VALUES (%s, %s)"""
# data_hyip = (huy, da)
#
# cursor.execute(add_hyip, data_hyip)
# cnx.commit()
# cursor.close()
# cnx.close()

# ~~~

da = random.randrange(1000000000000000)
# du = Path.cwd().parts
# du1 = du.parts
# du + da + "png"
# path = Path(__file__).parent.absolute()
path = str(Path(__file__).parent.absolute())


# du2 = ''.join(Path.cwd().parts)

# ~~~
def __hyip_url(self, hyip_url):
    display = Xvfb()
    display.start()
    options = Options()
    options.headless = True
    options.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    driver = webdriver.Chrome(options=options)
    driver.get(hyip_url)
    hyip_url = driver.current_url
    kak = self.get_url(hyip_url)
    driver.close()
    display.stop()

    display = Xvfb()
    display.start()
    options = Options()
    options.headless = True
    options.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    driver = webdriver.Chrome(options=options)
    driver.get(kak)
    driver.set_window_size(1366, 768)
    driver.maximize_window()
    path = str(Path(__file__).parent.absolute())
    random_number = str(random.randrange(1000000000000000))
    image_path = path + "/images/" + random_number + ".png"
    driver.save_screenshot(image_path)
    driver.close()
    display.stop()
    return [self.get_url(kak), image_path]


# ~~~
def __hyip_url(self, hyip_url):
    display = Xvfb()
    display.start()
    options = Options()
    options.headless = True
    options.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    driver = webdriver.Chrome(options=options)
    driver.get(hyip_url)
    h1 = driver.current_url
    h2 = self.get_url(h1)
    driver.get(h2)
    driver.set_window_size(1366, 768)
    driver.maximize_window()
    path = str(Path(__file__).parent.absolute())
    random_number = str(random.randrange(1000000000000000))
    image_path = path + "/images/" + random_number + ".png"
    driver.save_screenshot(image_path)
    driver.close()
    display.stop()
    return [h2, image_path]

    # ~~~


time.sleep(0.3)


# ~~~

def __hyip_url(hyip_url):
    display = Xvfb()
    display.start()
    options = Options()
    options.headless = True
    options.add_argument(
        "user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    driver = webdriver.Chrome(options=options)
    try:
        driver.get(hyip_url)
        hyip_url = driver.current_url
    except TimeoutException:
        hyip_url = "xxx"
        pass

    driver.close()
    display.stop()
    return hyip.get_url(hyip_url)


st = time.time()
kak = __hyip_url("http://localhost/hyip/py/ph/test.php")
et = time.time()
t = et - st


# ~~~
def get_url(self, url):
    try:
        a = url.rsplit("//")
        b = a[1].rsplit("/")
        url = a[0] + "//" + b[0]
    except Exception:
        url = "xxx"
        pass

    return url


# ~~~
for n in hyips:
    st = time.time()
    hyip.append(n.find("a").get_text().strip().capitalize())
    url.append(self.__hyip_url(n.find("a").attrs['href']))
    kak = self.__get_status(n.find("div", {"class": "status"}).attrs['class'])
    status.append(kak)
    ttm.append(time.time() - st)

self.__store_hyip(monitor, hyip, url, status, ttm)

if s[1] == "status1":
    status = 1


# ~~~
def get_url(url):
    try:
        if url.lower().find("www.") != -1:
            a = url.rsplit("//")
            b = a[1].rsplit("/")
            c = b[0].rsplit(".")
            url = a[0] + "//" + c[1] + "." + c[2]
        else:
            a = url.rsplit("//")
            b = a[1].rsplit("/")
            url = a[0] + "//" + b[0]
    except Exception:
        url = "xxx"
        pass

    return url

# ~~~
