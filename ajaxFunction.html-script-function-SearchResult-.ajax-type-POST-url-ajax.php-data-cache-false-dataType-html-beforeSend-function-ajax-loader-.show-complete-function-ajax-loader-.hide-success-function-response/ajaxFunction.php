<script>
function SearchResult()
{
	$.ajax({
		type: "POST",
		url: 'ajax.php',
		data: '',
		cache: false,
		dataType: "html",
		beforeSend: function() {
			$("#ajax-loader").show();
		},
		complete: function() {
			$("#ajax-loader").hide();
		},
		success: function(response)
		{
			
		}
	
	});	
}
</script>
