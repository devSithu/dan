function displaySelectedPhoto(selectedfile_id,img_id){
    var fileSelected=document.getElementById(selectedfile_id).files;
    var image_ui=document.getElementById(img_id);
    //alert(fileSelected.length);
    if(fileSelected.length>0){
        var fileToLoad=fileSelected[0];
        if(fileToLoad.type.match("image.*")){
            var fileReader=new FileReader();
            fileReader.onload=function(fileLoadedEvent){
                image_ui.src=fileLoadedEvent.target.result;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
}