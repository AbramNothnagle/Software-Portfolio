#Abram Nothnagle
#This program counts Pythagorean triples
import math
import time
M = int(raw_input("Give a positive integer: "))
x = 1
y = 1
EXIST = 0
start = time.time()
while (x<=M):
    while (y<=M):
        #These two while loops test all combinations of x and y
        z = math.sqrt((x**2)+(y**2))
        if (z == z//1):
            #This tests if the float "z" is equal to an integer
            EXIST = EXIST+1
            #EXIST is the counting variable
        y = y+1
    y = x+1 #resets y to test more combinations
    x = x+1
end = time.time()
print "This took",(end-start), "seconds" #Displays time
print "There are",EXIST,"Pythagorean triples"

