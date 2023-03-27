import mysql.connector
from selenium.common.exceptions import TimeoutException
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from bs4 import BeautifulSoup
import time
from datetime import datetime
from pyvirtualdisplay import Display


def record_line(line, disp):
    with open("/var/www/html/py/alexa/logg.txt", "a") as f:
        t = datetime.now()
        t = t.strftime("%H:%M:%S")
        line = line + " " + t + " " + disp + "\n"
        f.write(line)


cnx = mysql.connector.connect(host='localhost', user='al', passwd='111', database='hyip')
cursor = cnx.cursor()

hit = [0]
query = "SELECT monitor FROM monitor WHERE hit = %s LIMIT 1"
cursor.execute(query, hit)
monitors = cursor.fetchall()

# record_line("line 27")

source = None
alexa = None
elapsed = None
monitor = None

for m in monitors:
    monitor = m[0]

hit = 1
update_monitor = "UPDATE monitor SET hit = %s WHERE monitor = %s"
data_monitor = (hit, monitor)
cursor.execute(update_monitor, data_monitor)
cnx.commit()

# monitor = get_monitor()
# monitor = "https://x-invest.net"
# monitor = "https://hyipbanker.com"
# monitor = "https://earnhyipmonitor.net"
monitor = "https://www.allhyipmonitors.com/details/funds-broker.com"
if monitor:
    mon = monitor.replace("http://", "")
    mon = mon.replace("https://", "")
    mon = mon.replace("www.", "")
    driver = None
    display = None
    try:
        # record_line("line 52")
        with Display() as disp:
            record_line("line 76", "disp alive " + str(disp.is_alive()))
            options = Options()
            options.add_argument('--headless')
            options.add_argument('hide-scrollbars')
            options.add_argument('user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 '
                                 '(KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36')

            driver = webdriver.Chrome(options=options, executable_path="/var/www/html/py/chromedriver")
            driver.set_window_size(1366, 768)
            driver.maximize_window()
            start = time.time()
            driver.get(monitor)
            elapsed = time.time() - start
            driver.save_screenshot("/var/www/html/py/alexa/pics-sel/" + mon + ".png")
            source = driver.page_source

            driver.get('https://siterankdata.com/' + mon)
            alexa = driver.page_source

        record_line("line 109", "disp alive " + str(disp.is_alive()))

    except TimeoutException as e:
        print(e)
        if driver is not None:
            driver.quit()
    finally:
        if driver is not None:
            driver.quit()

    with open("/var/www/html/py/alexa/selenium/" + mon + ".htm", "w") as fp:
        fp.write(source)

    bs = BeautifulSoup(alexa, features="html.parser")
    rank = bs.find('h1', class_='font-extra-bold m-t-xl m-b-xs text-success').get_text().strip()
    rank = rank.replace(",", "")

    update_monitor = "UPDATE monitor SET alexa = %s, elapsed = %s WHERE monitor = %s"
    data_monitor = (rank, elapsed, monitor)
    cursor.execute(update_monitor, data_monitor)
    cnx.commit()
    # record_line("line 107")

cursor.close()
cnx.close()
