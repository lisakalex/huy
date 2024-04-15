from bs4 import BeautifulSoup
import mysql.connector
from selenium.common.exceptions import TimeoutException
import requests
import time

cnx = mysql.connector.connect(host='localhost', user='al', passwd='111', database='hyip')
cursor = cnx.cursor()

hit = [0]
query = "SELECT monitor FROM monitor WHERE hit = %s LIMIT 10"
cursor.execute(query, hit)
monitors = cursor.fetchall()

for m in monitors:
    monitor = m[0]
    source1 = None
    source = None
    elapsed = None

    hit = 1
    update_monitor = "UPDATE monitor SET hit = %s WHERE monitor = %s"
    data_monitor = (hit, monitor)
    cursor.execute(update_monitor, data_monitor)
    cnx.commit()

    mon = monitor.replace("http://", "")
    mon = mon.replace("https://", "")
    mon = mon.replace("www.", "")

    try:
        source = requests.get('https://siterankdata.com/' + mon, timeout=120)
        start = time.time()
        source1 = requests.get(monitor, timeout=120)
        elapsed = time.time() - start
    except TimeoutException:
        source = "xxx"
        pass

    with open("/var/www/html/internetspeed/pic/" + mon + ".htm", "w") as fp:
        fp.write(source1.text)

    bs = BeautifulSoup(source.text, features="html.parser")
    rank = bs.find('h1', class_='font-extra-bold m-t-xl m-b-xs text-success').get_text().strip()
    rank = rank.replace(",", "")

    update_monitor = "UPDATE monitor SET alexa = %s, elapsed = %s WHERE monitor = %s"
    data_monitor = (rank, elapsed, monitor)
    cursor.execute(update_monitor, data_monitor)
    cnx.commit()
    time.sleep(1)

cursor.close()
cnx.close()
