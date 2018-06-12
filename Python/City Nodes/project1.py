#Abram Nothnagle
def getCoordinates(cityName): #function to get coordinates
    w = 0
    while (w <= 127): #gets the index of the city
        if (cityName == cities[w]):
            call = w
            break
        w = w+1
    return coordinates[call] #coordinates[call] corresponds to cities[call]
def getPopulation(cityName): #function to get populations
    w = 0
    while (w <= 127): #gets the index of the city
        if (cityName == cities[w]):
            call = w
            break
        w = w+1
    return population[call] #population[call] corresponds to cities[call]
def getDistance(cityName1, cityName2): #function to get distances between two places
    w1 = 0
    w2 = 0
    while (w1 <= 127): #gets index of first city
        if (cityName1 == cities[w1]):
            call1 = w1
        w1 = w1+1
    while (w2 <= 127): #gets index of second city
        if (cityName2 == cities[w2]):
            call2 = w2
        w2 = w2+1
    if (call2 > call1): #cityName1 has to come first in the file, so the "if"s just make sure that the distances are called correctly.
        return distances[call2].split()[call1+1] #call1+1 is here to avoid the first object created by the range function, because of the way values were assigned.
    if (call1 > call2):
        return distances[call1].split()[call2+1]
def nearbyCities(cityName, r): #returns cities within radius r of cityName
    w = 0
    nearby = [] #create the nearby list
    while (w <= 127): #get the cities index
        if (cityName == cities[w]):
            call = w
        w = w+1
    x = 0
    while (x<=126): #stores nearby cities into nearby
        if (int(distances[call].split()[x+1]) <= r): #again, the x+1 is here because of the problem started by the range function. This checks to see if every distance is within r.
            nearby = nearby + [cities[x]] #stores that city into nearby
        x=x+1
    nearby.sort()  #sorts the cities alphabetically
    return nearby
def printCities(line): #picks out the city name
    return line.split("[")[0].replace(",","") #splits the line at [ to get only the city name. Clears the name of the unnecessary ","
def printCoordinates(line): #picks out the city coordinates
    return "["+line.split("[")[1].split("]")[0]+"]" #Gets the objects between [] (the coordinates) and makes sure they are formatted such that coordinates = [coor1,coor2]
def printPopulation(line): #picks out the city populations
    return line.split("]")[1] #The remaining part of the line after ] is the population
f = open("miles.txt","r")
index = -1 #index starts at -1 because 1 will be added to it before it needs to put something in position 0. It will be used as a counter for distances.
cities = []
coordinates = []
population = []
distances = range(0,128,1) #makes sure that distances can be assigned by calling an index
for line in f: #checks every line
    if (len(line.split()) > 1): #checks to see if there are more than one objects in the line
        if ("[" in line): #city name lines have [ in them, so this checks if the line is a city name line
            cities = cities+[printCities(line)]#adds city names to cities
            coordinates = coordinates+[printCoordinates(line)] #adds coordinates to coordinates
            population = population+[printPopulation(line)] #adds the city populaions to population
            index = index + 1 #increases the index for distances
        else:
            distances[index] = str(distances[index]) + " " + str(line.split()).replace("'","").replace(",","").replace("[","").replace("]","") #adds the string of the old distances[index] and the string of the line below whatever city name line corresponds to that index.          
    else: #if there are not more than one objects in the line, it must be a distance, so it assignes the distance.
        distances[index] = str(distances[index]) + " " + str(line.split()).replace("'","").replace(",","").replace("[","").replace("]","")
track = 0 #track will be used as a counter for the position of a city.
while (track < 128):
    trackCount = track #trackCount will be used for cities past the city corresponding to "track" in the list. Will be an index value.
    while (trackCount < 127):
        if (trackCount == track): #if the city is that city
            distances[track] = str(distances[track]) + " " + "0" #add distance 0
        else:
            distances[track] = str(distances[track]) + " " + str(distances[trackCount].split()[track-1]) #makes sure to add the corresponding distance from the second city (the one corresponding to trackCount in this case) to the distances of index "track". This is a way of picking out the distances from other cities and adding them.
        trackCount = trackCount + 1
    track = track + 1
#Everything from here on out gives the user their options and then prints the output of the function they chose
print ("would you like to find:")
print ("city coordinates? - 1")
print ("city populations? - 2")
print ("The distance from one city to another? - 3")
print ("Or check what cities are within a radius of a city? - 4")
choice = int(raw_input())
if (choice == 1):
    cityName = str(raw_input("Enter the cities name: "))
    print getCoordinates(cityName)
elif (choice == 2):
    cityName = str(raw_input("Enter the cities name: "))
    print getPopulation(cityName)
elif (choice == 3):
    cityName1 = str(raw_input("Enter the first city name: "))
    cityName2 = str(raw_input("Enter the second city name: "))
    print getDistance(cityName1, cityName2)
elif (choice == 4):
    cityName = str(raw_input("Enter city name: "))
    r = int(raw_input("Enter radius: "))
    print nearbyCities(cityName, r)
else:
    print "invalid choice, sorry"