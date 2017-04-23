jQuery(document).ready(function() {
    jQuery("form").attr("enctype", "multipart/form-data");
	jQuery( "#fromdate" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'mm/dd/yy',
		onSelect: function(dateText, inst){
			jQuery("#todate").datepicker("option","minDate",
			jQuery("#fromdate").datepicker("getDate"));
		}		
    });
    jQuery( "#todate" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'mm/dd/yy',
		onSelect: function(dateText, inst){
			jQuery("#fromdate").datepicker("option","maxDate",
			jQuery("#todate").datepicker("getDate"));
		}		
    });
});


function isValiddoc(imagename)
{	
    imagefile_value = imagename.value;
    var checkimg = imagefile_value.toLowerCase();
    if (!checkimg.match(/(\.pdf|\.xls|\.txt|\.doc|\.PDF|\.XLS|\.DOC|\.docx|\.DOCX)$/))
    {
        alert("Please Upload Pdf or Document File Only");
        imagename.focus(); 
        imagename.value="";
        return false;
    }
    else
    {
        return true;
    }
}
