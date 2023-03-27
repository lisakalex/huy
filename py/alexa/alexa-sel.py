#!/var/www/html/venv/bin/python

import mysql.connector
from selenium.common.exceptions import TimeoutException
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from xvfbwrapper import Xvfb


cnx = mysql.connector.connect(host='localhost', user='al', passwd='111', database='hyip')
cursor = cnx.cursor()


def get_monitor():
    hit = [0]
    query = "SELECT monitor FROM monitor WHERE hit = %s LIMIT 1"
    cursor.execute(query, hit)

    monitor = None

    for (mon) in cursor:
        monitor = mon[0]

    hit = 1
    update_monitor = "UPDATE monitor SET hit = %s WHERE monitor = %s"
    data_monitor = (hit, monitor)
    cursor.execute(update_monitor, data_monitor)
    cnx.commit()
    return monitor


def get_source():
    # monitor = get_monitor()
    # monitor = "https://x-invest.net"
    monitor = "https://hyipbanker.com"
    if monitor != None:
        mon = monitor.replace("http://", "")
        mon = mon.replace("https://", "")
        mon = mon.replace("www.", "")

        display = Xvfb()
        display.start()
        options = Options()
        options.headless = True
        options.add_argument("hide-scrollbars")

        options.add_argument(
            "user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
        driver = webdriver.Chrome(options=options)
        try:
            driver.set_window_size(1366, 768)
            driver.maximize_window()
            driver.set_script_timeout(30)
            driver.get(monitor)
            source = driver.page_source
            # issue = driver.get_issue_message()
            # log = driver.get_log(ConnectionError)
            # log1 = driver.get_log(Exception)
            # ga = driver.get_network_conditions()
            with open("/var/www/html/py/alexa/selenium/" + mon + ".htm", "w") as fp:
                fp.write(source)
            driver.save_screenshot("/var/www/html/py/alexa/pics-sel/" + mon + ".png")
        except TimeoutException:
            source = "xxx"
        pass

        driver.close()
        display.stop()
        # bs = BeautifulSoup(source, features="html.parser")
        # rank = bs.find('h1', class_='font-extra-bold m-t-xl m-b-xs text-success').get_text().strip()
        # rank = rank.replace(",", "")
        #
        # update_monitor = "UPDATE monitor SET alexa = %s WHERE monitor = %s"
        # data_monitor = (rank, monitor)
        # cursor.execute(update_monitor, data_monitor)
        # cnx.commit()
        # cursor.close()
        # cnx.close()


get_source()
