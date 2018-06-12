#Abram Nothnagle

#Check to see if three points are colinear
def areCollinear(p1,p2,p3):
    if (p1[0]==p2[0]==p3[0]): #If on undefined line, still counted as on a line
        return True
    elif (p1[0] != p2[0] and p2[0] != p3[0]): #As long as none of the points form undefined lines, the slope calculations can be done
        slope = (p2[1]-p1[1])/(p2[0]-p1[0])
        slope2 = (p3[1]-p2[1])/(p3[0]-p2[0])
        if (slope == slope2):
            return True
        else:
            return False
    else: #If only two points share the same X value, the third one isn't on a line
        return False
		
#Check if a list of points are colinear
def collinearityTest(pointList):
    BREAK = "" #allows for a way to break from all while loops at once
    i = 2 #counter for the third point
    t = 0 #counter for the first point
    q = 2 #counter for the second point
    answer = []
    while ((t+q+i+1) < count): #for these while loops, they will stop when the end of the pointList list is reached
    #since t, q, and i are counters to determine index, t+q+i+1 makes sure that the index of any point (p1-p3) doesn't exceed that of pointList.
        while ((t+q+i+1) < count):
            while ((t+q+i+1) < count):
                #here the points (p1-p3) are assigned to values from pointList
                p1 = [pointList[t]]+[pointList[t+1]]
                p2 = [pointList[t+q]]+[pointList[t+q+1]]
                p3 = [pointList[t+q+i]]+[pointList[t+q+1+i]]
                if (areCollinear(p1,p2,p3)):
                    answer = [p1] + [p2] + [p3]
                    #after one set of points is found, the program no longer needs to run, so we break from the loops
                    BREAK = "break" #this will tell the other loops to break
                    break
                i = i + 1 #increase counter i
            if (BREAK == "break"):
                break #continue to break free
            q = q + 1 #increase counter q
            i = 1 #reset i
        if (BREAK == "break"):
            break #continue to break free
        t = t + 1 #increase counter t
        q = 1 #reset q
    return answer
pointList = []
x = 1
global count #count will keep track of the size of pointList
count = 0
while (x != ""): #x1 leaves open the option to end the while loop
    x = str(raw_input("Enter your point your points (X-space-Y. Enter to end): "))
    if (x == ""):
        break #this makes sure that "" (end condition) isn't added to pointList.
    point = str.split(x) #splits up the point to get X and Y
    point[0] = float(point[0]) #sets X to position 0
    point[1] = float(point[1]) #sets Y to position 1
    pointList = pointList + [point[0]] + [point[1]] #adds both points to pointList
    count = count + 2 #count goes up by two, because 2 coordinates are added with one run through the loop
print collinearityTest(pointList)