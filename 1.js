// dataset
const lists = ['11', '12', 'cii', '001', '2', '1998', '7', '89', 'iia', 'fii']
// get only string
const strings = lists.filter(item => isNaN(item))

// function for get algoritm lexicograph
// parameter only array
const lexicoGraphs = (arrays = []) => {

    // get unique array from permutations
    const getUniquePermutations = (array) => {
        let uniquePermutations = []
        for (let permutation of array) {
            if (!uniquePermutations.includes(permutation)) {
                uniquePermutations.push(permutation)
            }
        }
        return uniquePermutations
    }

    // get permutation algo
    const permutation = (str = '') => {
        const n = str.length // get string length
        // check string length
        if (n == 0) {
            console.log('empty');
        }
        // storing data result to array
        var array = []

        // get first permutation using substring loop
        // get start string position loop 
        for (let i = 0; i < n; i++) {
            let first = str.substring(0, i + 1)
            // push to storing data
            array.push(first)
        }
        // get emd string position using loop
        for (let i = 0; i < n; i++) {
            let second = str.substring(i + 1)
            // check string is not empty
            if (second != "") {
                // push to storing data
                array.push(second)
            }
        }
        // return data
        return array
    }

    // result from lexicograph
    var newResult = {
        S: []
    }
    // loop a arrays
    arrays.map(str => {
        // get permutation data
        const result = permutation(str)
        // store to result data
        newResult[str] = result
        // for get all data permutation 
        result.map(item => {
            // storing all data permutation
            newResult['S'].push(item)
        })
    })

    // get unique from data all permutation
    newResult['S'] = getUniquePermutations(newResult['S'])

    // return data
    return newResult
}

const lexc = lexicoGraphs(strings)
console.log(lexc);