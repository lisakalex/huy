import random

# calculate status to get performance
# R - rate
# t - total monitors quantity
# p - paying monitors quantity (percentage)
# n - not paying monitors quantity
# R = ((t + p - n)/2)*0.999*0.987

t = 10
p = 1
n = 99

# pp = p / t * 100
# R = t + pp - n
ra = random.random()
# r1 = t / 100
# r2 = r1 * ra
# r3 = t + r2
rate = t + random.random()
hu = None
