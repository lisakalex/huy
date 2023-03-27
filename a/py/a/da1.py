from selenium import webdriver
import time

driver = webdriver.Chrome()

# driver.get("http://pythonscraping.com/pages/javascript/ajaxDemo.html")
# driver.get("https://display.Investment market.com/")
# driver.get("https://forexprofits.biz/")
driver.get("https://www.namecheap.com/domains/whois/result?domain=forexprofits.biz")
time.sleep(3)
# print(driver.find_element_by_id("content").text)
# print(driver.page_source)
a = driver.page_source
print(driver.get)
# driver.get_screenshot_as_file(filename=/pythonProject/ku.png)
# print(driver.get_screenshot_as_file("foo2.png"))
# driver.maximize_window()
# driver.save_screenshot("foo2.png")
driver.close()
