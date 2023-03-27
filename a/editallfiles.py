import glob2

# this file must be in top directory where all files to be edited
for filepath in glob2.iglob('./**/*.html', recursive=True):
    with open(filepath) as file:
        s = file.read()
    s = s.replace('https://www.oracletutorial.com', '')
    with open(filepath, "w") as file:
        file.write(s)
