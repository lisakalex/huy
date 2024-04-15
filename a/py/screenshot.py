import argparse
from selenium import webdriver

if __name__ == '__main__':
    parser = argparse.ArgumentParser(description="This will get whois.")
    parser.add_argument('-u', '--uuu', required=True, help="url")
    parser.add_argument('-f', '--fff', required=True, help="file")
    args = parser.parse_args()


def write_details():
    driver = webdriver.Chrome()
    driver.get(args.uuu)
    driver.maximize_window()
    driver.save_screenshot(args.fff)
    driver.close()


write_details()

# -u https://www.toptal.com -f hhh
