import mysql.connector
import csv

with open("/var/www/html/sql/address.csv", "r") as f:
    addresses = [tuple(line) for line in csv.reader(f)]

cnx = mysql.connector.connect(host='localhost', user='al', passwd='111', database='hyip')
cursor = cnx.cursor()

sql = "INSERT INTO trans(address) VALUES (%s)"
cursor.executemany(sql, addresses)
cnx.commit()
cursor.close()
cnx.close()
