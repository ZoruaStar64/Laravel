
const selectTags = () => ({
        
    open: false, //This is used in the search function which is currently unused (and also really unneccasary)
    textInput: "",
    color: "#FFFFFF",
    newColor: "",
    tags: [],
    tagsList: [],
    init() {
        this.tags = JSON.parse(this.$el.parentNode.getAttribute('data-tags')); 
    },
    addTag(tag, color) {
        const tagName = tag.trim();
        if(this.tags.length < 3 && tag !== "" && !this.hasTag(tagName)) {
            this.tags.push({name:tagName, color});
            console.log(`The tag ${tagName} has been added`);
        } 
        this.clearSearch();
        this.updateTagsEvent();
    },
    hasTag(tag) {
        const existingIndex = this.tags.findIndex((existingtag) => {
            return existingtag.name.toLowerCase() === tag.toLowerCase();
        }); 
        return existingIndex !== -1;
    },
    removeTag(index) {
        this.tags.splice(index, 1);
        this.toggleSearch();
    },
    updateTagColor(index, newColor) {
        console.log(this.tags);
        this.tags[index]['color'] = newColor;
    },
    updateTagsEvent() {
        this.$el.dispatchEvent(new CustomEvent('tags-update', {
            detail: { tags: this.tags },
            bubbles: true,
        }));
    },
    search(q) {
        // This exists as a filter (and to immediatly add the tag after finishing the filter)
    },
    clearSearch() {
        this.textInput = '';
        this.toggleSearch();
    },
    toggleSearch() {
        this.open = this.textInput != '';
    }
})

export default selectTags;