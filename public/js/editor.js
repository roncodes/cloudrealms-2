$(function() {
	isMouseDown = false
    $('body').mousedown(function() {
        isMouseDown = true;
    })
    .mouseup(function() {
        isMouseDown = false;
    });
	var map_width = screen.availWidth;
	var map_height = screen.availHeight;
	var tile_width = map_width/40;
	var tile_height = map_height/23;
	var map_tools_open = 0;
	$('.dropdown-toggle').dropdown();
	$("#map_ground").fadeTo("slow", 0.33);
	$("#tiles").css('margin-right', -($("#tiles").width()+10));
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
/* Global vars not onload */
var selected_tile = null;
var base_url = 'http://localhost/cloudrealms3/';
var tiles_open = 0;
var grid_x = 40;
var grid_y = 23;
var layer = 'environment';
var tile_width = Math.round(screen.availWidth/40);
var tile_height = Math.round(screen.availHeight/23);
var lcation;
var parse_tile = function(tile){
	if(tile!=null){
		tile = tile.replace('{', '');
		tile = tile.replace('}', '');
		tile = tile.split('|');
	}
	return tile;
}
var load_map_ground = function(location){
	$.post(base_url+"editor/ajax/?action=get_ground&location="+location, function(data){
		var loc = "'"+location+"'";
		id = 0;
		if(data!=''){
			data = data.split(',');
			for(i=0;i<grid_x;i++){
				for(j=0;j<grid_y;j++){
					tile = parse_tile(data[id]);
					if(tile[3]!='tilesheet'){
						// MATH TIME!
						var stretch_width;
						var stretch_height;
						var img = new Image();
						img.onload = function() {
							// alert(this.width + 'x' + this.height);
							columns = this.width/tile[6];
							rows = this.height/tile[6];
							stretch_width = columns*tile_width;
							stretch_height = rows*tile_height;
							// alert(stretch_width+' x '+stretch_height);
						}
						img.src = base_url+tile[3];
						$('#map_ground').append('<div id="g_'+i+'_'+j+'" onmousedown="set_tile_click('+id+', '+loc+', this);" onmouseover="set_tile('+id+', '+loc+', this);" class="ground_tile" style="width:'+tile_width+'px;height:'+tile_height+'px;"><div style="background:url('+base_url+tile[3]+');background-position:-'+tile[4]+'px -'+tile[5]+'px;height:'+tile[6]+'px;width:'+tile[6]+'px;background-size:'+stretch_width+'px '+stretch_height+'px;"></div></div>');
					} else {
						$('#map_ground').append('<div id="g_'+i+'_'+j+'" onmousedown="set_tile_click('+id+', '+loc+', this);" onmouseover="set_tile('+id+', '+loc+', this);" class="ground_tile" style="width:'+tile_width+'px;height:'+tile_height+'px;"></div>');
					}
					id++;
				}
			}
		} else {
			for(i=0;i<grid_x;i++){
				for(j=0;j<grid_y;j++){
					$('#map_ground').append('<div id="g_'+i+'_'+j+'" onmousedown="set_tile_click('+id+', '+loc+', this);" onmouseover="set_tile('+id+', '+loc+', this);" class="ground_tile" style="width:'+tile_width+'px;height:'+tile_height+'px;"></div>');
					id++;
				}
			}
		}
	});
}
var load_map_environment = function(location){
	$.post(base_url+"editor/ajax/?action=get_environment&location="+location, function(data){
		var loc = "'"+location+"'";
		id = 0;
		if(data!=''){
			data = data.split(',');
			for(i=0;i<grid_x;i++){
				for(j=0;j<grid_y;j++){
					tile = parse_tile(data[id]);
					if(tile[3]!='tilesheet'){
						// MATH TIME!
						var stretch_width;
						var stretch_height;
						var img = new Image();
						img.onload = function() {
							// alert(this.width + 'x' + this.height);
							columns = this.width/tile[6];
							rows = this.height/tile[6];
							stretch_width = columns*tile_width;
							stretch_height = rows*tile_height;
							// alert(stretch_width+' x '+stretch_height);
						}
						img.src = base_url+tile[3];
						$('#map_environment').append('<div id="e_'+i+'_'+j+'" onmousedown="set_tile_click('+id+', '+loc+', this);" onmouseover="set_tile('+id+', '+loc+', this);" class="environment_tile" style="width:'+tile_width+'px;height:'+tile_height+'px;"><div style="background:url('+base_url+tile[3]+');background-position:-'+tile[4]+'px -'+tile[5]+'px;height:'+tile[6]+'px;width:'+tile[6]+'px;"></div></div>');
					} else {
						$('#map_environment').append('<div id="e_'+i+'_'+j+'" onmousedown="set_tile_click('+id+', '+loc+', this);" onmouseover="set_tile('+id+', '+loc+', this);" class="environment_tile" style="width:'+tile_width+'px;height:'+tile_height+'px;"></div>');
					}
					id++;
				}
			}
		} else {
			for(i=0;i<grid_x;i++){
				for(j=0;j<grid_y;j++){
					$('#map_environment').append('<div id="e_'+i+'_'+j+'" onmousedown="set_tile_click('+id+', '+loc+', this);" onmouseover="set_tile('+id+', '+loc+', this);" class="environment_tile" style="width:'+tile_width+'px;height:'+tile_height+'px;"></div>');
					id++;
				}
			}
		}
	});
}
var display_map = function(){
	$("#map_environment").css('z-index', '500');
	$("#map_environment").fadeTo("slow", 1);
	$("#map_ground").css('z-index', '300');
	$("#map_ground").fadeTo("slow", 1);
	layer = 'environment_layer';
}
var ground_layer = function(){
	$("#map_environment").css('z-index', '300');
	$("#map_environment").fadeTo("slow", 0.33);
	$("#map_ground").css('z-index', '500');
	$("#map_ground").fadeTo("slow", 1);
	layer = 'ground';
}
var environment_layer = function(){
	$("#map_ground").css('z-index', '300');
	$("#map_ground").fadeTo("slow", 0.33);
	$("#map_environment").css('z-index', '500');
	$("#map_environment").fadeTo("slow", 1);
	layer = 'environment';
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
	$.post(base_url+"editor/ajax/?action=delete_resource&resource="+resource, function(data){
		if(data=='success'){
			$(id).fadeOut();
			notif("success", "Success!", "Resource was deleted");
		} else {
			notif("error", "Failure", "Resource failed to delete, try again");
		}
	});
}
var display_tilesheet = function(id, boxwidth){
	$("#tiles").animate({width: boxwidth}, 400);
	$('#tile-container').html($(id).html());
}
var close_tiles = function(){
	$("#tiles").animate({marginRight: -($("#tiles").width()+10)}, 400);
}
var open_tiles = function(){
	if(!tiles_open){
		$("#tiles").animate({marginRight: 0}, 400);
		tiles_open = 1;
	} else {
		close_tiles();
		tiles_open = 0;
	}
}
var set_tile = function(id, location, tile){
	if(isMouseDown){
		if(selected_tile!=null){
			$.post(base_url+"editor/ajax/?action=set_tile&tilesheet="+selected_tile[0]+"&offx="+selected_tile[1]+"&offy="+selected_tile[2]+"&id="+id+"&layer="+layer+"&location="+location+"&size="+selected_tile[3], function(data){
				if(data=='success'){
					$(tile).html('<div style="background:url('+base_url+selected_tile[0]+');background-position:-'+selected_tile[1]+'px -'+selected_tile[2]+'px;height:'+selected_tile[3]+'px;width:'+selected_tile[3]+'px;"></div>');
				}
			});
		} else {
			notif("error", "No tile selected!", "");
		}
	}
}
var set_tile_click = function(id, location, tile){
	if(selected_tile!=null){
		$.post(base_url+"editor/ajax/?action=set_tile&tilesheet="+selected_tile[0]+"&offx="+selected_tile[1]+"&offy="+selected_tile[2]+"&id="+id+"&layer="+layer+"&location="+location+"&size="+selected_tile[3], function(data){
			if(data=='success'){
				$(tile).html('<div style="background:url('+base_url+selected_tile[0]+');background-position:-'+selected_tile[1]+'px -'+selected_tile[2]+'px;height:'+selected_tile[3]+'px;width:'+selected_tile[3]+'px;"></div>');
			}
		});
	} else {
		notif("error", "No tile selected!", "");
	}
}
var select_tile = function(tilesheet, offx, offy, size){
	selected_tile = new Array(tilesheet, offx, offy, size);
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
var save_map = function(location){
	var ground_map = '';
	var environment_map = '';
	$(".ground_tile").each(function(i) {
		tile_data = parse_tile_id($(this).attr('id'));
		if($(this).children("div")){
			element_data = parse_inner_element($(this).children("div"));
		}
		if(element_data[0]!=''){
			ground_map += '{'+i+'|'+tile_data[1]+'|'+tile_data[2]+'|tilesheet|xoff|yoff|size},';
		} else {
			ground_map += '{'+i+'|'+tile_data[1]+'|'+tile_data[2]+'|'+element_data[0]+'|'+element_data[1]+'|yoff|'+element_data[2]+',';
		}
	});
	$(".environment_tile").each(function(i) {
		tile_data = parse_tile_id($(this).attr('id'));
		if($(this).children("div")){
			element_data = parse_inner_element($(this).children("div"));
		}
		if(element_data[0]!=''){
			environment_map += '{'+i+'|'+tile_data[1]+'|'+tile_data[2]+'|tilesheet|xoff|yoff|size},';
		} else {
			environment_map += '{'+i+'|'+tile_data[1]+'|'+tile_data[2]+'|'+element_data[0]+'|'+element_data[1]+'|yoff|'+element_data[2]+',';
		}
	});
	$.post(base_url+"editor/ajax/?action=save_map", {ground_map: ground_map, environment_map: environment_map, location: location}, function(data){
		if(data=='success'){
			notif("success", "Map Saved", "Map has been successfully saved");
		} else {
			notif("error", "Failure", "Map failed to save");
		}
	});
}
var first_save = function(location){
	var ground_map = '';
	var environment_map = '';
	$(".ground_tile").each(function(i) {
		tile_data = parse_tile_id($(this).attr('id'));
		ground_map += '{'+i+'|'+tile_data[1]+'|'+tile_data[2]+'|tilesheet|xoff|yoff|size},';
	});
	$(".environment_tile").each(function(i) {
		tile_data = parse_tile_id($(this).attr('id'));
		environment_map += '{'+i+'|'+tile_data[1]+'|'+tile_data[2]+'|tilesheet|xoff|yoff|size},';
	});
	$.post(base_url+"editor/ajax/?action=save_map", {ground_map: ground_map, environment_map: environment_map, location: location}, function(data){
		if(data=='success'){
			notif("success", "Map Saved", "Map has been successfully saved");
		} else {
			notif("error", "Failure", "Map failed to save");
		}
	});
}
var parse_tile_id = function(id){
	// e_x_y
	data = id.split('_');
	return data;
}
var parse_inner_element = function(ele){
	if(ele){
		element_data[0] = $(ele).css('background');
		element_data[1] = $(ele).css('background-position');
		element_data[2] = $(ele).css('width');
	}
	return element_data;
}
var new_location_form = function(){
	$('#start_body').html($('#new_location').html());
}
var cancel_new_location = function(){
	$('#start_body').html($('#start_page').html());
}
var create_new_location = function(){
	$.post(base_url+"editor/ajax/?action=create_location&location_name="+$('#location_name').val(), function(data){
		if(data=='success'){
			window.location = base_url+"editor/map_editor/"+$('#location_name').val().toLowerCase();
		} else if(data=='name_exist'){
			notif("error", "Failure", "Location name already exist");
		} else {
			notif("error", "Failure", "Location failed to create");
		}
	});
}
