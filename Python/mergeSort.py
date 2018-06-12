# Assumes that L[first:mid+1] is sorted and also
# that L[mid: last+1] is sorted. Returns L with L[first: last+1] sorted

def merge(L, first, mid, last):
    
    i = first # index into the first half
    j = mid + 1 # index into the second half

    tempList = []
    
    # This loops goes on as long as BOTH i and j stay within their
    # respective sorted blocks
    while (i <= mid) and (j <= last):
        if L[i] <= L[j]:
            tempList.append(L[i])
            #print L[i], "from the first block"
            i += 1
        else:
            tempList.append(L[j])
            #print L[j], "from the second block"
            j += 1
            
    # If i goes beyond the first block, there may be some elements
    # in the second block that need to be copied into tempList.
    # Similarly, if j goes beyond the second block, there may be some
    # elements in the first block that need to be copied into tempList
    if i == mid + 1:
        tempList.extend(L[j:last+1])
        #print L[j:last+1], "some elements in second block are left over"
    elif j == last+1:
        tempList.extend(L[i:mid+1])
        #print L[i:mid+1], "some elements from first block are left over"
        
    L[first:last+1] = tempList
    #print tempList
    

# The merge sort function; sorts the sublist L[first:last+1]    
def generalMergeSort(L, first, last):
    # Base case: if first == last then it is already sorted
    
    # Recursive case: L[first:last+1] has size 2 or more
    if first < last:
        # divide step
        mid = (first + last)/2
        
        # conquer step
        generalMergeSort(L, first, mid)
        print L[first:mid+1]
        generalMergeSort(L, mid+1, last)
        print L[mid+1:last+1]
        # combine step
        merge(L, first, mid, last)
        print L[first:last+1]
        
        
# Wrapper function
def mergeSort(L):
    generalMergeSort(L, 0, len(L)-1)
mergeSort([5,3,4,7,2])