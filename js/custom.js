$(document).ready(function() {
    
   
    //Example 1
    $('#filer_input').filer({
		showThumbs: true
    });
     
    //Example 2
    $("#filer_input2").filer({
        limit: null,
        maxSize: null,
        extensions: ['mp3'],
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="fa fa-music"></i></div><div class="jFiler-input-text"><h3>Drag&Drop Music File here </h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null 
        },
        
        uploadFile: {
            url: "controller/controller_albume_music_upload.php",
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            beforeSend: function(){
               //  $('.jFiler-items jFiler-row').html('<h1>Hello world !<h1>');
            },
            success: function(data, el){
                //    console.log(data);
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");    
                });
                
            },
            error: function(el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
                });
            },
            statusCode: null,
            onProgress: function(){
                var bodyAlbumeInfo = '<div class="containerAlbumeInfo containerAlbumeInfosss"><b class="titleAlbums"> Create Album </b><table class="table"><tr><td><b class="titleAlbums vvvdd"> Name of Album </b><input class="inpualbinfo albumTitleNameH" type="text" placeholder="Untitled Album" /></td><td><b class="titleAlbums vvvdd"> Image to be a cover for album  </b><input id="image-albume-cover" class="inpualbinfo sdsdsd" type="file" /></td></tr></table></div>' ;
                var clasNamsContainerInfo = $('.containerAlbumeInfosss');
                 if(clasNamsContainerInfo.length == 0){
                    $('.jFiler-items-list').before(bodyAlbumeInfo);
                    
                }
                
            }  ,
            onComplete: function (data){
                 
                var clasNamsContainerInfo = $('.containerAlbumeInfo');
                 if(clasNamsContainerInfo.length != 0){
                   var saveArea = '<div class="containerAlbumeInfo containerBtnss"> <button typical="n" onclick="saveShareOrOnly(this)" class="btn btn-primary btnssavings">Save Only</button><select id="accessPrem" style="width: auto;padding: 7px;order: 1px dashed #dfdfdf;" class="btn post-btn"><option value="0">Friends</option><option value="1">Public</option><option value="2">Only me</option></select></div>';
                    $('.jFiler-items-list').after(saveArea);
                 }
            }
            
        },
        files: null,
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
            var file = file.name;
            $.post('controller/controller_albume_music_remove.php', {file: file});
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Choose Files",
            feedback: "Choose files To Upload",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            removeConfirmation: "Are you sure you want to remove this file?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Musics with .mp3 are allowed to be uploaded.",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        } 
    });
    
    
    
     $('.mmGabesd').click(function(){
        $('.mmuploads').trigger('click');
        $('.GetALlAlbums ').fadeOut();
          $('.containerUpload').fadeIn();
      });
      
});
