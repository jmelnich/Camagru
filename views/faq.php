<div class="container">
	<form class="form" id="faq" action="faq" method="POST">
		<div class="form-group">
				<label>*Your question or suggestion</label>
				<textarea type="text" class="form-control-text" name="text" value="<?php echo escape(Input::get('text')); ?>"><?php echo escape(Input::get('text')); ?></textarea>
		</div>
		<div class="form-group">
			<label>*Your name</label>
			<input type="text" class="form-control" name="name" value="<?php echo escape(Input::get('name')); ?>">
		</div>
		<div class="form-group">
			<label>*Yor email</label>
			<input type="text" class="form-control" name="email" value="<?php echo escape(Input::get('email')); ?>">
		</div>
		<button type="submit" name="submit" class="btn btn-primary">Send</button>
	</form>
</div>