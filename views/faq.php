<div class="container">
	<form id="faq" action="faq" method="POST">
		<div class="form-group">
				<label>Your question or suggestion</label>
				<textarea type="text" class="form-control-text" name="text"></textarea>
		</div>
		<div class="form-group">
			<label>Your name</label>
			<input type="text" class="form-control" name="name">
		</div>
		<div class="form-group">
			<label>Yor email</label>
			<input type="text" class="form-control" name="email">
		</div>
		<span class="error"><?php echo $data?></span>
		<button type="submit" name="submit" class="btn btn-primary">Send</button>
	</form>
</div>