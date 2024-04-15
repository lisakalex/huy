import json
import os
from datetime import datetime
from selenium import webdriver
import time


class DAA3:
    def __init__(self, url):
        """
        Update the monthly_release file with the details of the new deployment and write a release.html
        :param api_name: name of the api that has been released
        :param deploy_version the version of the api deployed to the environment.
        """
        self.url = url

    def write_details(self):
        driver = webdriver.Chrome()

        # driver.get("http://pythonscraping.com/pages/javascript/ajaxDemo.html")
        # driver.get("https://display.Investment market.com/")
        # driver.get("https://forexprofits.biz/")
        # driver.get("https://www.namecheap.com/domains/whois/result?domain=forexprofits.biz")
        # driver.get("https://www.namecheap.com/domains/whois/result?domain=" + self.url)
        u = "https://www.namecheap.com/domains/whois/result?domain=" + self.url

        huy = None
        driver.get(u)
        time.sleep(2)
        # print(driver.find_element_by_id("content").text)
        # print(driver.page_source)
        a = driver.page_source
        # print(driver.get)
        # driver.get_screenshot_as_file(filename=/pythonProject/ku.png)
        # print(driver.get_screenshot_as_file("foo2.png"))
        # driver.maximize_window()
        # driver.save_screenshot("foo2.png")
        driver.close()
        return a
