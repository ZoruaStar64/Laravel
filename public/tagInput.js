
// document.getElementById("test").innerHTML = "JavascriptTest!";
// Hints:
// Use this. everywhere except for at hasTag in which case you gotta use return
// removeTag requires a value within it's function to work
// remember to add the 3 max tags filter at addTag
// some functions are called in nested divs (divs inside divs) 
// call keyDown and click functions with @ (also sometimes they use .prevent make sure to look up what that does)
const selectTags = () => {
    return {
        open: false, //If im right this is to Enable/Disable the input field
        tags: ['this', 'is', 'good', 'not'],
        textInput: '',
        init() {
            //this will contain an array of values that need to exist upon load
        },
        addTag() {
            //this will add a tag to the tags array after several other functions
            if(this.tags.length < 4) {
                console.log('is nice');
            } else {
                console.log('is not nice');
            }
        },
        hasTag() {
            // This function will check if a tag is empty or already exists within the tags array
        },
        removeTag(index) {
            // does literally what the name says
        },
        updateTagsEvent() {
            // Im pretty sure this isn't neccasary and only exists for debugging/testing purposes
        },
        search(q) {
            // This exists as a filter (and to immediatly add the tag after finishing the filter)
        },
        clearSearch() {
            // just empties the search bar and fires the toggleSearch function
            this.textInput = '';
            this.toggleSearch();
        },
        toggleSearch() {
            // This can toggle the search on/off
            this.open = this.textInput;
        }
    }
}

export default selectTags;