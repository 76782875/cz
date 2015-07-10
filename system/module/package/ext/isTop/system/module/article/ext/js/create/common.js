$(document).ready(function()
{
    $('#isTop').change(function()
    {   
        if($(this).prop('checked'))
        {   
            $(this).attr('value',1);
        }   
        else
        {   
			$(this).attr('value',0);
        }   
		//alert($(this).attr('value')); 
    }); 

});
