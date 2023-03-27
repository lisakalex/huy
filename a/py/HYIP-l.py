from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb
import time


class Hyipl:
    def __init__(self):
        """
        """

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

    def __source(self, monitor, site_name):
        start_time = time.time()
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
        driver.save_screenshot("/opt/lampp/htdocs/hyip/py/" + site_name + ".png")
        driver.close()
        display.stop()
        end_time = time.time()
        sel_time = end_time - start_time
        self.sel_time(sel_time, monitor)
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

    def t_time(self, t_time, monitor):
        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()

        update_monitor = "UPDATE monitor SET t_time = %s WHERE monitor = %s"
        data_monitor = (t_time, monitor)

        cursor.execute(update_monitor, data_monitor)
        cnx.commit()
        cursor.close()
        cnx.close()

    def __test_source(self):
        f = open("/a/ku.htm", "r")
        source = f.read()
        return BeautifulSoup(source)

    def __store_hyip(self, monitor, hyip, url, status):
        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()

        add_hyip = "INSERT INTO hyip (monitor, hyip, url, status) VALUES (%s, %s, %s, %s)"
        data_hyip = (monitor, hyip, url, status)

        cursor.execute(add_hyip, data_hyip)
        emp_no = cursor.lastrowid
        cnx.commit()
        cursor.close()
        cnx.close()

    def __store_hyip1(self, hyip_data):
        cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
        cursor = cnx.cursor()

        add_hyip = "INSERT INTO hyip (monitor, hyip, url, status) VALUES (%s, %s, %s, %s)"
        # data_hyip = (monitor, hyip, url, status)

        cursor.executemany(add_hyip, hyip_data)
        emp_no = cursor.lastrowid
        cnx.commit()
        cursor.close()
        cnx.close()

    def __get_status(self, status):
        s = 0
        if status.lower().find("paying") != -1 and status.lower().find("not paying") == -1:
            s = 1
        return s

    def quick(self, monitor):
        bs = self.__source(monitor, "quick")
        hyips = bs.find_all("div", {"class": "da"})

        for n in hyips:
            # hyip = n.find("div").get_text().capitalize()
            monitor = "huy"
            hyip = n.text
            url = "url"
            status = 1
            # url = n.find("a").attrs['href']
            # s = n.find("div", {"class": "status_vote"}).find("span").get_text()
            # status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def graspgold(self, monitor):
        bs = self.__source(monitor, "graspgold")
        hyips = bs.find_all('div', class_='details')

        for n in hyips:
            hyip = n.find('a').get_text().capitalize()
            url = n.find('a').attrs['href']
            s = n.find('div', class_='status_vote').find('span').get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def hyiphome(self, monitor):
        site_name = "hyiphome"
        bs = self.__source(monitor, site_name)
        hyips = bs.findAll("div", {"class": "main-col"})

        for n in hyips:
            hyip = n.find("a").get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("div", {"class": "b-status"}).get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def investtracing(self, monitor):
        bs = self.__source(monitor, "investtracing")
        hyips = bs.find_all("div", {"class": "listcontainer"})

        for n in hyips:
            hyip = n.find("a", {"class": "hyip"}).get_text().capitalize()
            url = "https://invest-tracing.com/" + n.find("a", {"class": "hyip"}).attrs['href']
            s = n.find("label", {"class": "label"}).get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def instantmonitor(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor)
        hyips = bs.findAll("div", {"class": "listcontainer"})

        for n in hyips:
            hyip = n.find("a").get_text().capitalize()
            url = "https://instant-monitor.com" + n.find("a").attrs['href']
            s = n.find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def goldlister(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor)
        hyips = bs.findAll("table", {"class": "summary"})

        for n in hyips:
            hyip = n.find("a").get_text().capitalize()
            url = "https://gold-lister.com/" + n.find("a").attrs['href']
            s = n.find("div", {"id": "statussite"}).attrs['class']
            status = self.__get_status(s[0])
            self.__store_hyip(monitor, hyip, url, status)

    def eurohyips(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor)
        hyips = bs.findAll("div", {"class": "projects_listing"})

        for n in hyips:
            hyip = n.find("a").get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("div", {"class": "project_status"}).find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def exclusiveprofit(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor, "exclusiveprofit")
        hyips = bs.find_all("div", {"class": "c-project-preview-top-row"})

        for n in hyips:
            hyip = n.find("a").get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def fairmonitor(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor)
        hyips = bs.findAll("table", {"class": "detn_stat1_block"})

        for n in hyips:
            hyip = n.find("a").get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def hyipclub(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor)
        hyips = bs.findAll("div", {"class": "khunglon"})

        for n in hyips:
            hyip = n.find("a").get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("div", {"class": "k-status"}).get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def keyhyip(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor)
        hyips = bs.findAll("div", {"class": "program"})

        for n in hyips:
            status = 0
            hyip = n.find("a").get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("div", {"class": "status"}).attrs['class']
            if s[1] == "status1":
                status = 1
            self.__store_hyip(monitor, hyip, url, status)

    def hyips(self, monitor):
        # bs = self.__test_source()
        bs = self.__source(monitor)
        hyips = bs.findAll("div", {"class": "listcontainer"})

        for n in hyips:
            hyip = n.find("a", {"class": "hyip"}).get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("label", {"class": "label"}).get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    def hyipexplorer(self, monitor):
        bs = self.__test_source()
        # bs = self.__source(monitor)
        hyips = bs.findAll("td", {"class": "clas1"})
        hyips1 = bs.findAll("span", {"class": "bl"})

        for n in hyips1:
            hyip1 = n.parent.previous_sibling.get_text()
            hyip = n.find("a").get_text().capitalize()
            url = n.find("a").attrs['href']
            s = n.find("span").get_text()
            status = self.__get_status(s)
            self.__store_hyip(monitor, hyip, url, status)

    huy = None
