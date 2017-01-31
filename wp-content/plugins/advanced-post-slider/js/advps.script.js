var wpversion;
jQuery(document).ready(function($) {
	//alert('got');
	var wpversion = $('meta[name=wpversion]').attr("content");
	//alert($('meta[name=wpversion]').attr("content"));
	$(".postbox h3.advps-expand,.postbox .handlediv").click(function(e){
		if($(this).hasClass('advps-highlight')){
			$(this).removeClass('advps-highlight')
		}
		if($(this).parent().hasClass('closed')){
		$(this).parent().removeClass('closed');
		$(this).parent().find(".handlediv").removeClass('down');
		$(this).parent().find(".handlediv").addClass('up');
		}
		else
		{
		$(this).parent().addClass('closed');
		$(this).parent().find(".handlediv").removeClass('up');
		$(this).parent().find(".handlediv").addClass('down');
		}
	});
	
	if(wpversion >= '3.5'){
	 	$(".advps-color-picker").wpColorPicker();
	}
	else{
		 jQuery('.advpsfarb').hide();
		 $('.advpsfarb').each(function() {
			 //alert();
			 var sell = $(this).parent().find('.advps-color-picker').attr('id');
			 //alert(sell);
			 jQuery(this).farbtastic("#"+sell);
		 });
		 
		 $('.advps-color-picker').click(function() {
        	$(this).parent().find('.advpsfarb').fadeIn();
		});
	
		$(document).mousedown(function() {
			$('.advpsfarb').each(function() {
				var display = $(this).css('display');
				if ( display == 'block' )
					$(this).fadeOut();
			});
		});
	 }//
});

function onlyNum(evt)
{
    var e = window.event || evt;
    var charCode = e.which || e.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;

}
function NumNdNeg(evt)
{
    var e = window.event || evt;
    var charCode = e.which || e.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 45)
        return false;

    return true;

}

function advpsCheckCat(p,n){
	var fldSel = 'advps-cat-field'+n;
	if(p != "page"){
		jQuery.ajax({
			  type : "post",
			  context: this,
			  dataType : "html",
			  url : advpsajx.ajaxurl, 
			  data : {action: "chkCaetegory",post_type:p,checkReq:advpsajx.advpsAjaxReqChck},        	
			  success: function(response) {
				 //alert(response);return;
					jQuery('#'+fldSel).html(response);
				},
				complete : function(){
					
				}
		});///
	}
	else
	{
		jQuery('#'+fldSel).html('');
	}
}

function advpsUpdateLabel(f,v,id){
	jQuery('#lbludtSts'+id).css('display','inline');
	jQuery.ajax({
		  type : "post",
		  context: this,
		  dataType : "html",
		  url : advpsajx.ajaxurl, 
		  data : {action: "advpsUpdateLabel",f_name:f,f_value:v,checkReq:advpsajx.advpsAjaxReqChck},        	
		  success: function(response) {
			 jQuery('#lbltxt'+id).html(v);
			jQuery('#lbludtSts'+id).css('display','none');
			},
			complete : function(){
				
			}
	});///
}
function updateOptionSet(id){
	var optdata = jQuery('#'+id).serialize();
	
	jQuery('.ajx-sts').html('');
	jQuery('#'+id).find('.ajx-loader').css('display','inline');
	
	jQuery.ajax({
		  type : "post",
		  context: this,
		  dataType : "html",
		  url : advpsajx.ajaxurl, 
		  data : {action: "advpsUpdateOpt",optdata:optdata,checkReq:advpsajx.advpsAjaxReqChck},        	
		  success: function(response) {
			 
			jQuery('#'+id).find('.ajx-loader').css('display','none');
			jQuery('#'+id).find('.ajx-sts').html(response);
			setTimeout('clearText()',4000);
			},
			complete : function(){
				
			}
	});///
}
function listPost(n){
	var fldSel = 'advps-plist-field'+n;
	
	var ptype = jQuery("#plist"+n+" select[name=advps_post_stypes]").val();
	var pmax = jQuery("#plist"+n+" input[name=advps_plistmax]").val();
	var porderBy = jQuery("#plist"+n+" select[name=advps_plistorder_by]").val();
	var porder = jQuery("#plist"+n+" select[name=advps_plistorder]").val();
	
	jQuery('#plist'+n).find('.ajx-loaderp').css('display','inline');
	
	jQuery.ajax({
		  type : "post",
		  context: this,
		  dataType : "html",
		  url : advpsajx.ajaxurl, 
		  data : {action: "advpsListPost",ptype:ptype,pmax:pmax,porderBy:porderBy,porder:porder,checkReq:advpsajx.advpsAjaxReqChck},        	
		  success: function(response) {
			 jQuery('#'+fldSel).html(response);
			 jQuery('#plist'+n).find('.ajx-loaderp').css('display','none');
			
		  },
		  complete : function(){
			  
		  }
	});///
}
function updateSm(elem,id){
	jQuery('#smudtsts'+id).css('display','inline');
	
	var selval = jQuery(elem).val();
	var selnam = jQuery(elem).attr('name');
	
	if(selval == 'query'){
		jQuery("#plist"+id+" table").addClass("advps-hide");
		jQuery("#query"+id+" table").removeClass("advps-hide");
	}
	else
	{
		jQuery("#query"+id+" table").addClass("advps-hide");
		jQuery("#plist"+id+" table").removeClass("advps-hide");
	}
	
	jQuery.ajax({
		  type : "post",
		  context: this,
		  dataType : "html",
		  url : advpsajx.ajaxurl, 
		  data : {action: "advpsUpdateSmethod",selnam:selnam,selval:selval,checkReq:advpsajx.advpsAjaxReqChck},        	
		  success: function(response) {	
		  	jQuery('#smudtsts'+id).css('display','none');
		  },
		  complete : function(){
			  
		  }
	});///
}

function deleteOptSet(id){
	var rsp = confirm("Do you really want to delete this slider?");
	if(rsp){
		jQuery("#frmOptDel"+id).removeAttr("onsubmit");
		jQuery("#frmOptDel"+id).submit();
	}
}
function duplicateOptSet(id){
	jQuery("#frmOptDel"+id).removeAttr("onsubmit");
	jQuery("#frmOptDel"+id).submit();
}
function pagerAttr(v){
	alert(v);
}
function clearText(){
	jQuery('.ajx-sts').html('');
}
function sliderType(v,id){
	if(v != 'standard'){
		jQuery("#advps-pthumb-lvl"+id).addClass('advps-fade');
		jQuery("#advps-pthumb"+id).attr('disabled','disabled');
	}
	else
	{
		jQuery("#advps-pthumb-lvl"+id).removeClass('advps-fade');
		jQuery("#advps-pthumb"+id).removeAttr('disabled');
	}
}