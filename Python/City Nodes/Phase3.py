#AbramNothnagle
import sys
import string

def smallestDistance(cityName,cities,distances, facilities, r):
    #This function gets the closest facility to a city
    x = 0
    nearestCityDistance = sys.maxint
    nearestCity = ""
    while (x<len(facilities)):
            if cityName in nearbyCities(facilities[x],r):
                if getDistance(cityName, facilities[x]) < nearestCityDistance:
                    nearestCityDistance = getDistance(cityName, facilities[x])
                    nearestCity = facilities[x]
            x = x +1
    return nearestCity

def display(facilities, cities, distances, coordinates, r, fout = "visualization.kml"):
    f = open(fout, "w")
    #This function writes the KML code to the file
    #Starts out the KML file
    f.write('<?xml version="1.0" encoding="UTF-8"?>')
    f.write('<kml xmlns="http://www.opengis.net/kml/2.2">')
    f.write('<Document>')
    f.write('<name>Facilities</name>')
    f.write('<Style id="downArrowIcon">')
    f.write('<IconStyle>')
    f.write('<Icon>')
    f.write('<href>http://maps.google.com/mapfiles/kml/pal4/icon28.png</href>')
    f.write('</Icon>')
    f.write('</IconStyle>')
    f.write('</Style>')    
    for i in range(len(facilities)):
        #Writes the code for placing cities
        f.write('<Placemark>')
        f.write('<name>'+facilities[i]+'</name>')
        f.write('<Point>')
        f.write('<coordinates>'+'-'+str(float(getCoordinates(facilities[i])[1])/100)+','+str(float(getCoordinates(facilities[i])[0])/100)+','+'0'+'</coordinates>')
        f.write('</Point>')
        f.write('</Placemark>')
        for u in nearbyCities(facilities[i],r):
            #Writest the code for drawing the lines
            f.write('<Placemark>')
            f.write('<visibility>1</visibility>')
            f.write('<LineString>')
            f.write('<tessellate>1</tessellate>')
            f.write('<altitudeMode>relativeToGround</altitudeMode>')
            f.write('<coordinates>'+'-'+str(float(getCoordinates(u)[1])/100)+','+str(float(getCoordinates(u)[0])/100)+',0'+" "+'-'+str(float(getCoordinates(smallestDistance(u,cities,distances, facilities, r))[1])/100)+','+str(float(getCoordinates(smallestDistance(u,cities,distances, facilities, r))[0])/100)+',0 </coordinates>')
            #smallestDistance is called to only draw lines to the closest city
            f.write('</LineString>')
            f.write('</Placemark>')
	    #Places floating arrows for all non-facility cities
	    if u not in facilities:
		f.write('<Placemark>')
		f.write('<styleUrl>#downArrowIcon</styleUrl>')
		f.write('<visibility>1</visibility>')
		f.write('<Point>')
		f.write('<altitudeMode>relativeToGround</altitudeMode>')
		f.write('<coordinates>'+'-'+str(float(getCoordinates(u)[1])/100)+','+str(float(getCoordinates(u)[0])/100)+',0</coordinates>')
		f.write('</Point>')
		f.write('</Placemark>')
    f.write('</Document>')
    f.write('</kml>') 
    f.close()
    return

def storeCity(line,cities) :
    ''' Extracts the city name and state and stores it. '''
    city  = line[:line.index(',')].strip()
    state = line[line.index(',')+1:line.index('[')].strip()
    cities.append(city + ' ' + state)
    
def storePopulation(line,population) :
    ''' Extracts the population from a line and stores it. '''
    population.append(int(line[line.index(']')+1:]))
    
def storeCoordinates(line,coordinates) :
    ''' Extracts the coordinates from a line and stores them. '''
    coordinates.append(map(int, line[line.index('[')+1 : line.index(']')].split(',')))

def storeDistances(newDistances,distances) :
    ''' Stores the distances to/from each city to the current city. '''
    
    # Skip over the first city since its distances haven't been seen yet
    if not cities : 
        return
    
    # Convert all new distances to integers
    newDistances = map(int, newDistances)
    
    # Compute dimension of new distances array - 1
    n = len(newDistances)-1
    
    # Set the distance of city from itself to zero
    distances.append([0])
    
    # For each city already seen
    for i in range(n+1) :
        # Append the distance to this city
        distances[n-i] = distances[n-i]    + [newDistances[i]]
        # Insert the distance from this city
        distances[n+1] = [newDistances[i]] + distances[n+1]
               
def isCityLine(line) :
    ''' Returns whether a line contains city information.'''
    return line[0].isalpha()

def isDistanceLine(line) :
    ''' Returns whether a line contains distance information.'''
    return line[0].isdigit()

def readCitiesData(filename) :
    """ Reads the city's data and populates the data structures """
    
    accDist = []     # Accumulates distances seen over several lines
    
    f = open(filename, "r")
    for line in f:
        # If this line has distances, accumulate the new distances
        if isDistanceLine(line) :
            accDist = accDist + line.split() 
        # If this line has data for a new city
        elif isCityLine(line) :
            # Store the distances accumulated for the previous city
            storeDistances(accDist,distances)
            accDist = []
            # Store the name, coordinates, and popuation for this city
            storeCity(line,cities)
            storeCoordinates(line,coordinates)
            storePopulation(line,population)              
    f.close()
    
    # Store the distances for the last city
    storeDistances(accDist,distances)
         
def getCoordinates(name) :
    ''' Returns the coordinates for a city as a list of lat and long.
        Returns an empty list if the city name is invalid. '''
    
    result = []
    if name in cities :
        result = coordinates[cities.index(name)]
    return result

def getPopulation(name) :
    ''' Returns the popultion for a city.
        Returns None if the city name is invalid.'''
           
    result = None
    if name in cities :
        result = population[cities.index(name)]
    return result
       
def getDistance(name1, name2) :
    ''' Returns the distance between two cities. 
        Returns None if either city's name is invalid.'''
           
    result = None
    if name1 in cities and name2 in cities :
        result = distances[cities.index(name1)][cities.index(name2)]
    return result

def nearbyCities(name, r) :
    ''' Returns a list of cities within distance r of named city
        sorted in alphabetical order.
        Returns an empty list if city name is invalid. '''
           
    result = []
    if name in cities :                # If the city name is valid
        i = cities.index(name)           # Get the index of the named city
        for j in range(len(cities)) :      # For every other city
            if distances[i][j] <= r :      # If within r of named city
                result = result + [cities[j]]  # Add to result
    result.sort() 
    return result

def unserved(served, cities, city, r) :
    ''' Returns the number of unserved cities within distance r of city. '''
    
    result = 0
  
    # for each city within distance r of city
    for c in nearbyCities(city, r) :
        # if not served, add it to the list of unserved citys
        if not served[cities.index(c)] :
            result = result + 1
    return result

def nextFacility(served, cities, distances, r) :
    ''' Returns the name of the city that can service the most unserved 
        cities within radius r. Returns None if all cities are served. '''
    
    facility = None      # Name of city that will be the next service facility
    numberServed = 0     # Number of cities that facility will serve
    
    # For each city
    for c in range(len(cities)) :
        # compute how many unserved cities will be served by city c
        willBeServed = unserved(served, cities, cities[c], r)
        # if it can serve more cities than the previous best city
        if willBeServed >  numberServed:
            # make it the service center
            facility = cities[c]
            numberServed = willBeServed
    return facility
            
def locateFacilities(cities, distances, r) :
    ''' Returns an alphabetically sorted list of the cities in which facilities
        must be located to service all cities with a service radius of r. '''
    
    # List of cities that are served by current facilities
    served = [False] * len(cities)
    
    # List of cities that are service facilities
    facilities = []
    
    # Get the city that is the next best service facility
    facility = nextFacility(served, cities, distances, r )
    
    # While there are more cities to be served
    while facility :
        
        # Mark the service facility as served
        served[cities.index(facility)] = True
        
        # Mark each city as served that will be served by this facility
        for city in nearbyCities(facility, r) :
            served[cities.index(city)] = True
            
          # Append the city to the list of service facilities
        facilities.append(facility)
        
        # Get the city that is the next best service facility
        facility = nextFacility(served, cities, distances, r)
        
    # Sort the list of facilties alphabetically
    facilities.sort()
    
    return facilities
       
""" Main body of the program. """ 
cities      = []     # List of valid city names (city name and state)
coordinates = []     # Coordinates (lat and long) of each city
population  = []     # Population of each city
distances   = []     # Distances to/from each pair of cities

# Read the map data for each city and store in data structures
readCitiesData("miles.dat")
facilities300 = locateFacilities(cities, distances, 300)
display(facilities300, cities, distances, coordinates, 300,"visualization300.kml")
facilities800 = locateFacilities(cities, distances, 800)
display(facilities800, cities, distances, coordinates, 800,"visualization800.kml")