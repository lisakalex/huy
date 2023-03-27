import pymysql
import argparse
from selenium import webdriver

# if __name__ == '__main__':
#     parser = argparse.ArgumentParser(description="This will get url.")
#     parser.add_argument('-u', '--url', required=False, help="huy")
#     args = parser.parse_args()

conn = pymysql.connect(host='localhost', user='root', passwd=None, db='tihuy')
cur = conn.cursor()
cur.execute("SELECT * FROM alexa")
print(cur.fetchall())
cur.close()
conn.close()
