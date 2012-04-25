$(function() {
	var map_width = screen.availWidth;
	var map_height = screen.availHeight;
	var tile_width = map_width/40;
	var tile_height = map_height/23;
	var map_tools_open = 0;
	$('#map_editor').mouseover(function() {
		if(!map_tools_open){
			$('#map_tools').fadeIn();
			map_tools_open = 1;
		} else {
			$('#map_tools').fadeOut();
			map_tools_open = 0;
		}
	});
	load_map(0, tile_width, tile_height);
	var uploader = new qq.FileUploader({
		element: document.getElementById('uploader'),
		action: '../../../uploader/upload_resources',
		sizeLimit: 6789504,
		params: {'resource_type': $('#resource_type').val()},
		allowedExtensions: ['png', 'jpg', 'gif', 'mp3', 'ogg', 'flv', 'mov', 'wmv'],
		debug: true,
		onComplete: function(id, fileName, responseJSON){
			notif("info", "Update!", "Resource library has been modified");
			setTimeout('location.reload()', 1000);
		}
	}); 
	$('#resource_type').change(function() {
		uploader.setParams({
			resource_type: $('#resource_type').val()
		});
	});
});
var load_map = function(location_id, tile_width, tile_height){
	for(i=0;i<40;i++){
		for(j=0;j<23;j++){
			$('#map').append('<div class="tile" style="width:'+tile_width+'px;height:'+tile_height+'px;"></div>');
		}
	}
}
var resource_detail_open = 0;
var display_resource_details = function(div){
	if(resource_detail_open){
		$('#'+div).slideUp();
		resource_detail_open = 0;
	} else {
		$('#'+div).slideDown();
		resource_detail_open = 1;
	}
}
var delete_resource = function(resource, id){
	$.post("../../../editor/ajax/?action=delete_resource&resource="+resource, function(data){
		if(data=='success'){
			$(id).fadeOut();
			notif("success", "Success!", "Resource was deleted");
		} else {
			notif("error", "Failure", "Resource failed to delete, try again");
		}
	});
}
var notif = function(type, subject, notif){
	$('#notif-subject').html(subject);
	$('#notif-body').html(notif);
	$('#notif').addClass('alert-'+type); // diff types: success, error, info
	$('#notif').fadeIn();
	setTimeout(function(){$("#notif").fadeOut()}, 2000);
}
var close_notif = function(){
	$('#notif').fadeOut();
}
