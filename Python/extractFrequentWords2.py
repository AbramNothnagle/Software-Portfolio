#Abram Nothnagle

#Given a dictionary, determine the most frequent words in that dictionary
def mostFrequent(wordDictionary):
    L = wordDictionary.items()
    frequencies = []
    orderedFrequencies = []
    for i in L:
        frequencies.append(i[1])
    while len(orderedFrequencies) < 50 and len(frequencies) >0:
        orderedFrequencies.append(L[frequencies.index(max(frequencies))][0])
        del L[frequencies.index(max(frequencies))]
        del frequencies[frequencies.index(max(frequencies))]
    return orderedFrequencies

	#function filters out punctuation to make other operations easier
def filterOutPunctuation(punctuationMarks, s):
    for mark in punctuationMarks:
        s = s.replace(mark, " ")

    return s

#Set letters to lower case
def toLower(s):
    return s.lower()

#make a whole word list lower case
def makeListLower(wordList):
    return map(toLower, wordList)

fin = open("smallWar.txt", "r")

wordDictionary = {}

punctuationMarks = map(chr, range(0, ord("A")) + range(ord("Z")+1, ord("a")) + range(ord("z")+1, 127)) 

for line in fin:
    for word in filterOutPunctuation(punctuationMarks, line).split():
        if word not in wordDictionary:
            wordDictionary[word] = 1
        else:
            wordDictionary[word] = wordDictionary[word]+1
fin.close()
print len(mostFrequent(wordDictionary))