
// document.getElementById("test").innerHTML = "JavascriptTest!";
// Hints:
// Use this. everywhere except for at hasTag in which case you gotta use return
// removeTag requires a value within it's function to work
// remember to add the 3 max tags filter at addTag
// some functions are called in nested divs (divs inside divs) 
// call keyDown and click functions with @ (also sometimes they use .prevent make sure to look up what that does)
const selectTags = () => ({
        open: false, //If im right this is to Enable/Disable the input field
        textInput: "",
        color: "#FFF",
        newColor: "",
        tags: [],
        init() {
            //this will contain an array of values that need to exist upon load
            this.tags = JSON.parse(this.$el.parentNode.getAttribute('data-tags')); 
        },
        addTag(tag, color) {
            //this will add a tag to the tags array after several other functions
            // check if input = string and also check what hasTag returns
            console.log(color);
            const tagName = tag.trim();
            if(this.tags.length < 3 && tag !== "") {
                console.log('is nice');
                this.tags.push({name:tagName, color});
                console.log(this.tags);
            } else {
                console.log('is not nice');
            }
            this.clearSearch();
        },
        hasTag() {
            // This function will check if a tag is empty or already exists within the tags array
        },
        removeTag(index) {
            // gebruik hier splice (index, 1)
            this.tags.splice(index, 1);
            this.toggleSearch();
        },
        updateTagColor(index, newColor) {
            console.log(this.tags);
            this.tags[index]['color'] = newColor;
            
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
            this.open = this.textInput != '';
        }
    })


export default selectTags;