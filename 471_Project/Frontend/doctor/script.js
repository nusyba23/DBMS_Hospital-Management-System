function startEdits(){
    const div = document.querySelector(".basic-details");
    div.contentEditable=true;
    const medRecDiv =document.querySelector(".medical-record");
    medRecDiv.contentEditable=true;
    const saveButton = document.getElementById("save");
    saveButton.classList.add("show");
    
}