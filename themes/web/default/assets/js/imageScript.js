function showImage(src, target) {
    var fr = new FileReader();
    fr.onload = function(){
        target.src = fr.result;
    }
    fr.readAsDataURL(src.files[0]);
}

function putImage(src_id,target_id,btn_id) {
    var src = document.getElementById(src_id);
    var target = document.getElementById(target_id);
    showImage(src, target);

    //show save btn if ok
    $('#'+btn_id).show();
}

function OpenImgUpload(src_id,btn_id){
    $('#'+src_id).trigger('click');
}
