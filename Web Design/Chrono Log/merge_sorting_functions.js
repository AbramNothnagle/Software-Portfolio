// Merge function to sort entry objects into alphabetical order with the last name
function merge_alphabetical(data) {
    
    var length = data.length;
        
        
        if (length === 1) {
            return [data[0]];
        }
        
        if (length === 2) {
            if (data[0].last.toLowerCase() > data[1].last.toLowerCase()) {
                return [data[1], data[0]];
            }
                        
            return [data[0], data[1]];
        }
            
        var first  = merge_alphabetical(data.slice(0, Math.ceil(length / 2)));
        var second = merge_alphabetical(data.slice(first.length));
        
        var result = [];
        
        while (first.length && second.length) {
            if (first[0].last.toLowerCase() > second[0].last.toLowerCase()) {
                result.push(second.shift());
            } else {
                result.push(first.shift());
            }
        }
        
    return result.concat(first, second);
}

// Merge function to sort entry objects into alphabetical order with the project_name
function merge_alphabetical_project_name(data) {
    
    var length = data.length;
        
        
        if (length === 1) {
            return [data[0]];
        }
        
        if (length === 2) {
            if (data[0].project_name.toLowerCase() > data[1].project_name.toLowerCase()) {
                return [data[1], data[0]];
            }
                        
            return [data[0], data[1]];
        }
            
        var first  = merge_alphabetical_project_name(data.slice(0, Math.ceil(length / 2)));
        var second = merge_alphabetical_project_name(data.slice(first.length));
        
        var result = [];
        
        while (first.length && second.length) {
            if (first[0].project_name.toLowerCase() > second[0].project_name.toLowerCase()) {
                result.push(second.shift());
            } else {
                result.push(first.shift());
            }
        }
        
    return result.concat(first, second);
}

// Merge function to sort the entry objects into order by date
function merge_date(data) {

    var length = data.length;
        
        
        if (length === 1) {
            
            return [data[0]];
        }
        
        if (length === 2) {
            if (moment(data[0].date).unix() > moment(data[1].date).unix()) {
                return [data[1], data[0]];
            }
            
            return [data[0], data[1]];
        }
            
        var first  = merge_date(data.slice(0, Math.ceil(length / 2)));
        var second = merge_date(data.slice(first.length));
        
        var result = [];
        
        while (first.length && second.length) {
            if (moment(first[0].date).unix() > moment(second[0].date).unix()) {
                
                result.push(second.shift());
            } else {
                
                result.push(first.shift());
            }
        }
        
    return result.concat(first, second);
}

// Merge function to sort entry objects into order by their length of time
function merge_length(data) {
    
    
    var length = data.length;
    
        if (length === 1) {
            return [data[0]];
        }
        
        if (length === 2) {
            if (moment.duration(data[0].time) > moment.duration(data[1].time)) {
                return [data[1], data[0]];
            }
                        
            return [data[0], data[1]];
        }
            
        var first  = merge_length(data.slice(0, Math.ceil(length / 2)));
        var second = merge_length(data.slice(first.length));
        
        var result = [];
        
        while (first.length && second.length) {
            if (moment.duration(first[0].time) > moment.duration(second[0].time)) {
                result.push(second.shift());
            } else {
                result.push(first.shift());
            }
        }
        
    return result.concat(first, second);
}