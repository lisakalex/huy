from Hyip import Hyip
import mysql.connector
import time

hyip = Hyip()
cnx = mysql.connector.connect(host='localhost', user='root', passwd=None, database='tihuy')
cursor = cnx.cursor()
query = "SELECT monitor FROM monitor"
cursor.execute(query)

for m in cursor:
    monitor = m[0]

    # monitor = hyip.monitor()
    # monitor = "https://hyipbusket.com"

    # if monitor == "http://192.236.160.198/quick.php":
    #     st = time.time()
    #     hyip.quick(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://graspgold.com" or monitor == "https://www.graspgold.com":
    #     st = time.time()
    #     hyip.graspgold(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://hyiphome.net" or monitor == "https://www.hyiphome.net":
    #     st = time.time()
    #     hyip.hyiphome(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://invest-tracing.com" or monitor == "https://www.invest-tracing.com":
    #     st = time.time()
    #     hyip.investtracing(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://instant-monitor.com" or monitor == "https://www.instant-monitor.com":
    #     st = time.time()
    #     hyip.instantmonitor(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://gold-lister.com" or monitor == "https://www.gold-lister.com":
    #     st = time.time()
    #     hyip.goldlister(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://eurohyips.net" or monitor == "https://www.eurohyips.net":
    #     st = time.time()
    #     hyip.eurohyips(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://exclusive-profit.com/?lang=fr" or monitor == "https://www.exclusive-profit.com/?lang=fr":
    #     st = time.time()
    #     hyip.exclusiveprofit(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    if monitor == "https://fairmonitor.com":
        st = time.time()
        hyip.fairmonitor(monitor)
        hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://hyipclub.club" or monitor == "https://www.hyipclub.club":
    #     st = time.time()
    #     hyip.hyipclub(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://keyhyip.com" or monitor == "https://www.keyhyip.com":
    #     st = time.time()
    #     hyip.keyhyip(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://hyips.bz" or monitor == "https://www.hyips.bz":
    #     st = time.time()
    #     hyip.hyips(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://hyipexplorer.com" or monitor == "https://www.hyipexplorer.com":
    #     st = time.time()
    #     hyip.hyipexplorer(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    # #
    # if monitor == "https://asianhyip.com" or monitor == "https://www.asianhyip.com":
    #     st = time.time()
    #     hyip.asianhyip(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://makemoneyventure.com" or monitor == "https://www.makemoneyventure.com":
    #     st = time.time()
    #     hyip.makemoneyventure(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)
    #
    # if monitor == "https://hyipbusket.com" or monitor == "https://www.hyipbusket.com":
    #     st = time.time()
    #     hyip.hyipbusket(monitor)
    #     hyip.ttm(monitor, (time.time() - st) / 60)

cursor.close()
cnx.close()

huy = None
