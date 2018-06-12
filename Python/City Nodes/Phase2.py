#Abram Nothnagle
def locateFacilities(cities, distances, r):
    served = [0]*128 #creates served array
    within = [0]*128 #creates within array, stores cities within distance
    distPoints = [] #stores distribution points
    count = 0 #count to set all served values to 0
    count2 = 0 #count for the cities index when calling distances
    count3 = 0 #count for secondary cities index when calling distances
    #Two cities indices are needed to call the distances for a city, then a distance from that list
    for i in distances: #creates a list called "within" to have a record of all cities within r of whatever city
        count = 0
        while (count < 128):
            if (int(i.split()[count]) <= r):
                within[count] = within[count] + 1
            count = count + 1
    #del(within[0]) #within[0] is just a list of meaningless numbers, because of list assignment
    while (0 in served): #While there are still unserved cities
        call = within.index(max(within))
        distPoints = distPoints + [cities[call]]
        served[call] = 1
        for u in distances[call].split(): #checks cities for if they are within r, then sets the corresponding "served" index to True
            if (int(u)<= r):
                served[distances[call].split().index(u)-1] = 1
        x = 0
        while (x < len(distances)): #goes through and sets distances to served to indicate that city has been served
            if (len([distances[x]]) > 1):
                if (distances[x].split()[call] <= r):
                    distances[x].split()[call] = "served"
            x = x + 1
        within[call] = 0
        distances[call] = "served"
    distPoints.sort() #sort
    return distPoints
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
    return int(population[call]) #population[call] corresponds to cities[call]
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
        return int(distances[call1].split()[call2+1]) #call2+1 is here to avoid the first object created by the range function, because of the way values were assigned.
    if (call1 > call2):
        return int(distances[call2].split()[call1+1])
    else:
        return 0
def nearbyCities(cityName, r): #returns cities within radius r of cityName
    w = 0
    nearby = [] #create the nearby list
    while (w <= 127): #get the cities index
        if (cityName == cities[w]):
            call = w
        w = w+1
    x = 0
    while (x<=127): #stores nearby cities into nearby
        if (int(distances[call].split()[x+1]) <= r): #again, the x+1 is here because of the problem started by the range function. This checks to see if every distance is within r.
            if (x < call): #stores that city into nearby
                nearby = nearby + [cities[call-x-1]] #specifically for cities before cities[call]
            else:
                nearby = nearby + [cities[x]]
        x=x+1
    nearby.sort()  #sorts the cities alphabetically
    return nearby
def printCities(line): #picks out the city name
    return line.split("[")[0].replace(",","") #splits the line at [ to get only the city name. Clears the name of the unnecessary ","
def printCoordinates(line): #picks out the city coordinates
    x = line.split("[")[1].split("]")[0].split(",") #Gets the objects between [] (the coordinates) and makes sure they are formatted such that coordinates = [coor1,coor2]
    x[0] = int(x[0])
    x[1] = int(x[1])
    return x
def printPopulation(line): #picks out the city populations
    return line.split("]")[1] #The remaining part of the line after ] is the population
f = open("miles.dat","r")
index = -1 #index starts at -1 because 1 will be added to it before it needs to put something in position 0. It will be used as a counter for distances.
cities = []
coordinates = []
population = []
distances = range(0,128,1) #makes sure that distances can be assigned by calling an index
for line in f: #checks every line
    if (len(line.split()) > 1): #checks to see if there is more than one object in the line
        if ("[" in line): #city name lines have [ in them, so this checks if the line is a city name line
            cities = cities+[printCities(line)]#adds city names to cities
            coordinates = coordinates+[printCoordinates(line)] #adds coordinates to coordinates
            population = population+[printPopulation(line)] #adds the city populaions to population
            index = index + 1 #increases the index for distances
        else:
            distances[index] = str(distances[index]) + " " + str(line.split()).replace("'","").replace(",","").replace("[","").replace("]","") #adds the string of the old distances[index] and the string of the line below whatever city name line corresponds to that index.          
    else: #if there is not more than one object in the line, it must be a distance, so it assignes the distance.
        distances[index] = str(distances[index]) + " " + str(line.split()).replace("'","").replace(",","").replace("[","").replace("]","")
track = 0 #track will be used as a counter for the position of a city.
while (track < 128):
    trackCount = track #trackCount will be used for cities past the city corresponding to "track" in the list. Will be an index value.
    while (trackCount < 128):
        if (trackCount == track): #if the city is that city
            distances[track] = str(distances[track]) + " " + "0" #add distance 0
        else:
            distances[track] = str(distances[track]) + " " + str(distances[trackCount].split()[len(distances[trackCount].split())-1-track]) #makes sure to add the corresponding distance from the second city (the one corresponding to trackCount in this case) to the distances of index "track". This is a way of picking out the distances from other cities and adding them.
        trackCount = trackCount + 1
    track = track + 1
print locateFacilities(cities, distances, 5000)