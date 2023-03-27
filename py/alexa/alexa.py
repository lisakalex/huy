# noinspection PyInterpreter
from bs4 import BeautifulSoup
import mysql.connector
import requests
import time

cnx = mysql.connector.connect(host='localhost', user='al', passwd='111', database='hyip')
cursor = cnx.cursor()

query = "update monitor set hit = 0"
cursor.execute(query)

query = "SELECT count(monitor) FROM monitor"
cursor.execute(query)

monitors = None

for (mon) in cursor:
    monitors = mon[0]

for m in range(monitors):
    time.sleep(1)
    hit = [0]
    query = "SELECT monitor FROM monitor WHERE hit = %s LIMIT 1"
    cursor.execute(query, hit)

    monitor = None

    for (mon) in cursor:
        monitor = mon[0]

    # monitor = "https://firehyip.com"  # testing

    hit = 1
    update_monitor = "UPDATE monitor SET hit = %s WHERE monitor = %s"
    data_monitor = (hit, monitor)
    cursor.execute(update_monitor, data_monitor)
    cnx.commit()

    mon = monitor.replace("http://", "")
    mon = mon.replace("https://", "")
    mon = mon.replace("www.", "")
    source1 = None
    source = None
    scode = None
    elapsed = None
    ex = None

    try:

        headers = {'user-agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
        source = requests.get('https://siterankdata.com/' + mon, headers=headers, timeout=None)
        start = time.time()
        source1 = requests.get(monitor, headers=headers, timeout=None)
        elapsed = time.time() - start
        scode = source1.status_code

    except Exception as e:
        ex = str(e)
        source1 = "xxx"
        pass


    with open("/var/www/html/py/alexa/requests/" + mon + ".htm", "w") as fp:
        if source1 != "xxx":
            fp.write(source1.text)

    bs = BeautifulSoup(source.text, features="html.parser")
    rank = bs.find('h1', class_='font-extra-bold m-t-xl m-b-xs text-success').get_text().strip()
    rank = int(rank.replace(",", ""))

    update_monitor = "UPDATE monitor SET alexa = %s, scode = %s, elapsed = %s, comment = %s WHERE monitor = %s"
    data_monitor = (rank, scode, elapsed, ex, monitor)
    cursor.execute(update_monitor, data_monitor)
    cnx.commit()

cursor.close()
cnx.close()
