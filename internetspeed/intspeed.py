# https://github.com/sivel/speedtest-cli
import speedtest as st
import mysql.connector
import time


def get_new_speeds():
    t1 = time.time()

    cnx = mysql.connector.connect(host='localhost', user='al', passwd='111', database='intspeed')
    cursor = cnx.cursor()

    speed_test = st.Speedtest()
    speed_test.get_best_server()

    # Get ping (miliseconds)
    ping = speed_test.results.ping
    # Perform download and upload speed tests (bits per second)
    download = speed_test.download()
    upload = speed_test.upload()

    # Convert download and upload speeds to megabits per second
    download_mbs = round(download / (10 ** 6), 2)
    upload_mbs = round(upload / (10 ** 6), 2)

    t2 = time.time()
    time_taken = t2 - t1

    add_hyip = "INSERT INTO speed (ping, download, upload, time_taken) VALUES (%s, %s, %s, %s)"
    data_hyip = (ping, download_mbs, upload_mbs, time_taken)

    cursor.execute(add_hyip, data_hyip)
    emp_no = cursor.lastrowid
    cnx.commit()

    cursor.close()
    cnx.close()


get_new_speeds()
