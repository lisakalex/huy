#! /usr/bin/python3
from a.DAA3 import DAA3
import argparse

if __name__ == '__main__':
    parser = argparse.ArgumentParser(description="This will get whois.")
    parser.add_argument('-u', '--url', required=True, help="URL")

    args = parser.parse_args()

    a = DAA3.write_details(args.url)
    print(a)
    b = None
