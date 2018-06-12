#AbramNothnagle

import time

def areNeighbors(w1, w2): #checks if two words are neighbors
    count = 0
    for i in range(len(w1)):
        if w1[i] != w2[i]:
            count = count + 1
    
    return count == 1

def readWords(wordList, D): #reads all the words into the program
    fin = open("words.dat", "r")

    for word in fin:
        newWord = word.strip("\n")
        wordList.append(newWord)
        D[newWord] = []

    fin.close()

def buildDictionary(wordList, D): #builds the networks
    numPairs = 0
    for i in range(len(wordList)):
        for j in range(i+1, len(wordList)):
            if areNeighbors(wordList[i], wordList[j]):
                D[wordList[i]].append(wordList[j])
                D[wordList[j]].append(wordList[i])
    return D
def degreeCounter(D): #counts all degrees
    for i in D:
        x = len(D[i])
        if x in degrees:
            degrees[x] = degrees[x]+1
        else:
            degrees[x] = 1
    return degrees
def printDegrees(degrees): #prints the degrees in increasing order
    x = max(degrees.keys())
    y = 0
    while y <= x:
        if y in degrees:
            print degrees[y]
        else:
            print 0
        y = y+1
# Main program
wordList = []
D = {}
degrees = {}
readWords(wordList, D)
buildDictionary(wordList, D)
degreeCounter(D)
printDegrees(degrees)