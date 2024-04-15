import pytesseract
import cv2
# from cv2 import cv2
import matplotlib.pyplot as plt
from PIL import Image

# image = Image.open("test1.JPEG")
# tessdata_dir_config = "/usr/share/tesseract-ocr/4.00/tessdata"
# output = pytesseract.image_to_string(image, lang='eng', config=tessdata_dir_config)
# pytesseract.pytesseract.tesseract_cmd = r'/home/al/pytesseract'
# print(pytesseract.image_to_string(Image.open('test1.JPEG')))

# image = cv2.imread("test.jpg")
image = Image.open("Screenshot from 2022-12-19 11-18-13.png")
string = pytesseract.image_to_string(image)
# # print it
print(string)
