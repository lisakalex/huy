from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb
import time
import random
from pathlib import Path
from selenium.common.exceptions import TimeoutException


class Hyip:
    def __init__(self):
        """
        """

    # def __get_cursor(self):
    #     cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
    #     return cnx.cursor()

    def monitor(self):
        """
        This will loop through the dictionary of APIs and write there content to a string to be inserted in the html
        file.
        :return: the string of api details to add.
        """
        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()

        query = "SELECT monitor FROM monitor WHERE hit = %s LIMIT 1"
        hit = [0]
        cursor.execute(query, hit)

        monitor = None

        for (mon) in cursor:
            monitor = mon[0]

        cursor.close()
        cnx.close()

        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()

        hit = 1
        update_monitor = "UPDATE monitor SET hit = %s WHERE monitor = %s"
        data_monitor = (hit, monitor)

        cursor.execute(update_monitor, data_monitor)
        cnx.commit()
        cursor.close()
        cnx.close()

        return monitor

    def __source(self, monitor):
        display = Xvfb()
        display.start()
        options = Options()
        options.headless = True
        options.add_argument(
            "user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
        options.add_argument("ignore-certificate-errors")
        options.add_argument("--no-sandbox");
        options.add_argument("--disable-blink-features=AutomationControlled")
        driver = webdriver.Chrome(options=options)
        try:
            driver.get(monitor)
            source = driver.page_source
        except TimeoutException:
            source = "xxx"
            pass

        driver.close()
        display.stop()
        return BeautifulSoup(source, features="html.parser")

    def sel_time(self, sel_time, monitor):
        """
        This will loop through the dictionary of APIs and write there content to a string to be inserted in the html
        file.
        :return: the string of api details to add.
        """

        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()

        update_monitor = "UPDATE monitor SET sel_time = %s WHERE monitor = %s"
        data_monitor = (sel_time, monitor)

        cursor.execute(update_monitor, data_monitor)
        cnx.commit()
        cursor.close()
        cnx.close()

    def ttm(self, monitor, ttm):
        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()
        update_monitor = "UPDATE monitor SET ttm = %s WHERE monitor = %s"
        data_monitor = (ttm, monitor)
        cursor.execute(update_monitor, data_monitor)
        cnx.commit()
        cursor.close()
        cnx.close()

    def __test_source(self):
        f = open("/a/ku.htm", "r")
        source = f.read()
        return BeautifulSoup(source)

    # def __store_hyip(self, monitor, hyip, url, status):
    #     cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
    #     cursor = cnx.cursor()
    #
    #     add_hyip = "INSERT INTO hyip (monitor, hyip, url, status) VALUES (%s, %s, %s, %s)"
    #     data_hyip = (monitor, hyip, url, status)
    #
    #     cursor.execute(add_hyip, data_hyip)
    #     emp_no = cursor.lastrowid
    #     cnx.commit()
    #     cursor.close()
    #     cnx.close()

    # def __store_hyip1(self, hyip_data):
    #     cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
    #     cursor = cnx.cursor()
    #     add_hyip = "INSERT INTO hyip (monitor, hyip, url, status, ttm) VALUES (%s, %s, %s, %s, %s)"
    #     cursor.executemany(add_hyip, hyip_data)
    #     emp_no = cursor.lastrowid
    #     cnx.commit()
    #     cursor.close()
    #     cnx.close()

    def __get_status(self, status):
        s = 0
        if status.lower().find("paying") != -1 and status.lower().find("not paying") == -1:
            s = 1
        return s

    # def __hyip_url(self, hyip_id, hyip_url):
    #     # start_time = time.time()
    #     # cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
    #     # cursor = cnx.cursor()
    #     #
    #     # query = "SELECT id, url FROM hyip WHERE hit = %s LIMIT 1"
    #     # hit = [0]
    #     # cursor.execute(query, hit)
    #     #
    #     # id = None
    #     # url = None
    #     #
    #     # for (h_id) in cursor:
    #     #     id = h_id[0]
    #     #     url = h_id[1]
    #     #
    #     # hit = 1
    #     # update_hyip = "UPDATE hyip SET hit = %s WHERE id = %s"
    #     # data_hyip = (hit, id)
    #     #
    #     # cursor.execute(update_hyip, data_hyip)
    #     # cnx.commit()
    #
    #     start_time = time.time()
    #     display = Xvfb()
    #     display.start()
    #     options = Options()
    #     options.headless = True
    #     options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
    #     driver = webdriver.Chrome(options=options)
    #     driver.get(hyip_url)
    #     hyip_url = driver.current_url
    #     driver.close()
    #     display.stop()
    #
    #     hyip_url = self.get_url(hyip_url)
    #
    #     end_time = time.time()
    #     huy = end_time - start_time
    #
    #     cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
    #     cursor = cnx.cursor()
    #     update_hyip = "UPDATE hyip SET url = %s, huy = %s, ttime = NOW() WHERE id = %s"
    #     data_hyip = (hyip_url, huy, hyip_id)
    #
    #     cursor.execute(update_hyip, data_hyip)
    #     cnx.commit()
    #     cursor.close()
    #     cnx.close()

    def __hyip_url(self, hyip_url):
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
        return self.get_url(hyip_url)

    def convert_url(self):
        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()

        query = "SELECT id, url FROM hyip"
        cursor.execute(query)

        for n in cursor:
            self.__hyip_url(n[0], n[1])

    def get_url(self, url):
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

    def __store_hyip(self, monitor, hyip, url, status, ttm):
        hyip_data = []
        for i in range(len(hyip)):
            h = (monitor, hyip[i], url[i], status[i], ttm[i])
            hyip_data.append(h)

        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()
        add_hyip = "INSERT INTO hyip (monitor, hyip, url, status, ttm) VALUES (%s, %s, %s, %s, %s)"
        cursor.executemany(add_hyip, hyip_data)
        emp_no = cursor.lastrowid
        cnx.commit()
        cursor.close()
        cnx.close()

    def quick(self, monitor):
        bs = self.__source(monitor, "quick")
        hyips = bs.find_all("div", {"class": "da"})

        for n in hyips:
            # hyip = n.find("div").get_text().strip().capitalize()
            monitor = "huy"
            hyip = n.text
            url = "url"
            status = 1
            # url = n.find("a").attrs['href']
            # s = n.find("div", {"class": "status_vote"}).find("span").get_text()
            # status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def graspgold(self, monitor):
        bs = self.__source(monitor, 'graspgold')
        hyips = bs.find_all('div', class_='details')

        for n in hyips:
            hyip = n.find('a').get_text().strip().capitalize()
            url = n.find('a').attrs['href']
            s = n.find('div', class_='status_vote').find('span').get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def hyiphome(self, monitor):
        bs = self.__source(monitor, 'hyiphome')
        hyips = bs.find_all('div', class_='main-col')

        for n in hyips:
            hyip = n.find('a').get_text().strip().capitalize()
            url = n.find('a').attrs['href']
            s = n.find('div', class_='b-status').get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def investtracing(self, monitor):
        bs = self.__source(monitor, "investtracing")
        hyips = bs.find_all("div", {"class": "listcontainer"})

        for n in hyips:
            hyip = n.find("a", {"class": "hyip"}).get_text().strip().capitalize()
            url = "https://invest-tracing.com/" + n.find("a", {"class": "hyip"}).attrs['href']
            s = n.find("label", {"class": "label"}).get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def instantmonitor(self, monitor):
        bs = self.__source(monitor, 'instantmonitor')
        hyips = bs.find_all("div", {"class": "listcontainer"})

        for n in hyips:
            hyip = n.find("a").get_text().strip().capitalize()
            url = "https://instant-monitor.com" + n.find("a").attrs['href']
            s = n.find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def goldlister(self, monitor):
        bs = self.__source(monitor, 'goldlister')
        hyips = bs.find_all("table", {"class": "summary"})

        for n in hyips:
            hyip = n.find("a").get_text().strip().capitalize()
            url = "https://gold-lister.com/" + n.find("a").attrs['href']
            s = n.find("div", {"id": "statussite"}).attrs['class']
            status = self.__get_status(s[0])
            self.__store_hyip(monitor, hyip, url, status)

    def eurohyips(self, monitor):
        bs = self.__source(monitor, 'eurohyips')
        hyips = bs.find_all("div", {"class": "projects_listing"})

        for n in hyips:
            hyip = n.find("a").get_text().strip().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("div", {"class": "project_status"}).find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def exclusiveprofit(self, monitor):
        bs = self.__source(monitor, "exclusiveprofit")
        hyips = bs.find_all("div", {"class": "c-project-preview-top-row"})

        for n in hyips:
            hyip = n.find("a").get_text().strip().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def fairmonitor(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)
        hyips = bs.find_all("table", {"class": "detn_stat1_block"})

        for n in hyips:
            st = time.time()
            hyip.append(n.find("a").get_text().strip().capitalize())
            url.append(self.__hyip_url(n.find("a").attrs['href']))
            status.append(self.__get_status(n.find("span").get_text()))
            ttm.append(time.time() - st)

        self.__store_hyip(monitor, hyip, url, status, ttm)

    def hyipclub(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)
        hyips = bs.find_all("div", {"class": "khunglon"})

        for n in hyips:
            st = time.time()
            hyip.append(n.find("a").get_text().strip().capitalize())
            url.append(self.__hyip_url(n.find("a").attrs['href']))
            status.append(self.__get_status(n.find("div", {"class": "k-status"}).get_text()))
            ttm.append(time.time() - st)

        self.__store_hyip(monitor, hyip, url, status, ttm)

    def keyhyip(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)
        hyips = bs.find_all("div", {"class": "program"})

        for n in hyips:
            st = time.time()
            ss = 0
            hyip.append(n.find("a").get_text().strip().capitalize())
            url.append(self.__hyip_url(n.find("a").attrs['href']))
            s = n.find("div", {"class": "status"}).attrs['class']
            if s[1] == "status1":
                ss = 1
            status.append(ss)
            ttm.append(time.time() - st)

        self.__store_hyip(monitor, hyip, url, status, ttm)

    def hyips(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)
        hyips = bs.find_all("div", {"class": "listcontainer"})

        for n in hyips:
            st = time.time()
            hyip.append(n.find("a", {"class": "hyip"}).get_text().strip().capitalize())
            url.append(self.__hyip_url(n.find("a").attrs['href']))
            status.append(self.__get_status(n.find("label", {"class": "label"}).get_text()))
            ttm.append(time.time() - st)

        self.__store_hyip(monitor, hyip, url, status, ttm)

    def hyipexplorer(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)

        for n in bs("font", color="red"):
            hyip.append(n.find_parent("b").text.strip().capitalize())

        for n in bs("a", string="Vote!"):
            st = time.time()
            u = n.attrs['href']
            u = int(''.join(filter(str.isdigit, u)))
            url.append(self.__hyip_url("https://www.hyipexplorer.com/visit.php?lid=" + str(u)))
            ttm.append(time.time() - st)

        for n in bs("span", class_="bl"):
            status.append(self.__get_status(n.find_parent().text))

        self.__store_hyip(monitor, hyip, url, status, ttm)

    def asianhyip(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)

        for n in bs("div", class_="program"):
            st = time.time()
            k = n.find("div", class_="title2")
            hyip.append(k.text.strip().capitalize())
            url.append(self.__hyip_url(k.a.attrs['href']))
            status.append(self.__get_status(k.next_sibling.next_sibling.text))
            ttm.append(time.time() - st)

        self.__store_hyip(monitor, hyip, url, status, ttm)

    def makemoneyventure(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)
        hyips = bs("div", class_="program")

        for n in hyips:
            st = time.time()
            hyip.append(n.find("div", class_="nameprogram").text.strip().strip().capitalize())
            url.append(self.__hyip_url(n.a.attrs['href']))
            status.append(self.__get_status(n.find("div", class_="m-status").text))
            ttm.append(time.time() - st)

        self.__store_hyip(monitor, hyip, url, status, ttm)

    def hyipbusket(self, monitor):
        hyip, url, status, hyip_data, ttm = [], [], [], [], []
        bs = self.__source(monitor)
        hyips = bs("div", class_="btmbdylftbx")

        for n in hyips:
            st = time.time()
            hyip.append(n.find("a").text.strip().strip().capitalize())
            url.append(self.__hyip_url(n.find("a").attrs['href']))
            status.append(self.__get_status(n.find("b").text))
            ttm.append(time.time() - st)

        self.__store_hyip(monitor, hyip, url, status, ttm)

        huy = None
