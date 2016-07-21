$( document ).ready(function() {

  
    $( "#uploadtype-url" ).click(function( event ) {
      
      activate_control("URL",$("#uploadtype-url"));
      
	});

$( "#uploadtype-file" ).click(function( event ) {
   	activate_control("FILE",$( "#uploadtype-file" ));
   });


   activate_control("FILE",$( "#uploadtype-file" ));
   
});

function activate_control(control,radio)
{
     var h = {}; 
     h['FILE'] = 'id_file';
     h['URL'] = 'id_url';
     
	 
	 for(var k in h)
     {
	   //building ids;
	   var name = h[k];
	   var label = "label[for='"+name+"number']"
	   var id = "#"+name;
           var value = "#"+name+"_data";
           
        if (k == control)
		{
		   //showing it!
		   $(id).show();
		   
		}
		else
		{
		   //hiding it
		   $(id).hide();
                   $("#upload-form").trigger('reset');
                   
                   
		   
		}
     }

     radio.prop("checked", true);	 
	 
}