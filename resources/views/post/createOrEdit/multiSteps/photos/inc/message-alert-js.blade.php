<script>
	/**
	 * Show Success Message
	 * @param message
	 */
	function showSuccessMessage(message)
	{
		let errorEl = $('#uploadError');
		let successEl = $('#uploadSuccess');
		
		errorEl.hide().empty();
		errorEl.removeClass('alert alert-block alert-danger');
		
		successEl.html('<ul></ul>').hide();
		successEl.find('ul').append(message);
		successEl.fadeIn('fast'); /* fast|slow */
	}
	
	/**
	 * Show Errors Message
	 * @param message
	 */
	function showErrorMessage(message)
	{
		jsAlert(message, 'error', false);
		
		let errorEl = $('#uploadError');
		let successEl = $('#uploadSuccess');
		
		successEl.empty().hide();
		
		errorEl.html('<ul></ul>').hide();
		errorEl.addClass('alert alert-block alert-danger');
		errorEl.find('ul').append(message);
		errorEl.fadeIn('fast'); /* fast|slow */
	}
</script>
