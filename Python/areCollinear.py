#Abram Nothnagle
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
#Here we initalize the lists so that specific indices can be called
p1 = [0,0]
p2 = [0,0]
p3 = [0,0]
#each coordinate value is added manually to the arrays for user convenience
#indices are used to place X and Y values in their correct spots
p1[0] = float(raw_input("Enter the X coordinate for point 1: "))
p1[1] = float(raw_input("Enter the Y coordinate for point 1: "))
p2[0] = float(raw_input("Enter the X coordinate for point 2: "))
p2[1] = float(raw_input("Enter the Y coordinate for point 2: "))
p3[0] = float(raw_input("Enter the X coordinate for point 3: "))
p3[1] = float(raw_input("Enter the Y coordinate for point 3: "))
print areCollinear(p1,p2,p3)