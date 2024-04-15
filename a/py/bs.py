from selenium import webdriver
from bs4 import BeautifulSoup
import mysql.connector
from selenium.webdriver.chrome.options import Options

# options = Options()
# options.headless = True
# options.binary_location = "/usr/bin/google-chrome-stable"
# options.add_argument("user-agent=Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36")
# driver = webdriver.Chrome(options=options)
# driver = webdriver.Chrome(executable_path="/home/da/pyproject/chrome-headless/drivers/chromedriver", options=options)
# driver.get(monitor)
# source = driver.page_source
# driver.set_window_size(1024, 600)
# driver.set_window_size(1366, 768)
# driver.set_window_size(1920, 1080)
# driver.set_window_size(1920, 1080)
# driver.maximize_window()
# driver.save_screenshot("/opt/lampp/htdocs/tihuy/py/" + site_name + ".png")
# driver.save_screenshot("/home/da/pyproject/chrome-headless/" + site_name + ".png")

# driver.save_screenshot("/opt/lampp/htdocs/tihuy/py/yyy.png")
# driver.save_screenshot("/home/da/pyproject/chrome-headless/yyy.png")
# driver.close()
# bs = BeautifulSoup(features="html.parser")
# bs = BeautifulSoup()
source = """
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
kuku
</body>
</html>"""
bs = BeautifulSoup(source)
t = bs.find("title").text
huy = "huy"
