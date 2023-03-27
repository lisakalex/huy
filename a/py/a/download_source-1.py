#! /usr/bin/python3
import pymysql
from selenium import webdriver
import argparse

if __name__ == '__main__':
    parser = argparse.ArgumentParser(description="This will get whois.")
    parser.add_argument('-u', '--url', required=False, help="huy")
    args = parser.parse_args()

    # conn = pymysql.connect(host='localhost', user='root', passwd=None, db='tihuy')
    # cur = conn.cursor()
    # cur.execute('SELECT `monitor` FROM monitor WHERE hit=0')
    # kak = cur.fetchone()
    # cur.close()
    # conn.close()
    # url = "https://invest-tracing.com"
    url = "https://graspgold.com/go/lid/3799/"
    driver = webdriver.Chrome()
    # driver.get(args.url)
    # driver.get(kak[0])
    driver.get(url)
    # a = driver.page_source
    a = driver.current_url
    driver.close()

    try:
        # with open("/opt/lampp/htdocs/tihuy/assets/source/source.htm", "w") as fp:
        with open("/ku.htm", "w") as fp:
            fp.write(a)
    except IOError as e:
        print("error writing to file")
