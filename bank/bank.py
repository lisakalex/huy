"""
process bank file, do not forget to change month and year
"""
month = "Jan 24"
try:
    with open("bank.txt", "r", encoding='utf-8') as hf:
        bank = hf.read()
        bank = bank.replace(month, month + "~")
        bank = bank.replace("£", "~")
        bank = bank.replace("-~", "~-~")
        bank = bank.replace("\n~", "~")

        bank_list = [ka for ka in bank.split('\n')]
        lines = []
        for line in bank_list:
            if line.find("~-~") == -1:
                a = line.rfind("~")
                b = a + 1
                lines.append(line[:a] + "~~" + line[b:])
            else:
                line = line.replace("~-~", "~~")
                lines.append(line)

        new_bank = '\n'.join(lines)
        new_bank = new_bank.title()

    with open("bank_out.txt", "w") as hf:
        hf.write(new_bank)

except IOError as e:
    print(e)
