<div class="container">
	<div class="filters">
		<h2>Choose a frame</h2>
		<ul class="filter-list" id="filter-list">
			<li><img class="faded" src="public/img/filters/hearts.png" alt="owl">
			<li><img class="faded" src="public/img/filters/green.png" alt="owl"></li>
			<li><img class="faded" src="public/img/filters/square_black.png" alt="black square"></li>
		</ul>
	</div>
	<div class="img-container" id="add-img">
		<label class="editor-uploader" title="Upload picture">
	    	<span class="editor-uploader-inner">
	        <i class="fa fa-picture-o"></i>
	        <i class="fa fa-plus"></i>
	    	</span>
	    	<img id="upload-preview" />
	    	<input id="upload-btn" type="file" accept="image/*">
		</label>
	</div>
	<div class="camera-container">
		<video id="video"></video>
		<button id="capture" class="btn btn-primary">Take snapshot</button>
	</div>
	<form action="add" method="post" class="canvas-container">
		<canvas id="canvas" width="400" height="300"></canvas>
		<input type="hidden" />
	</form>
</div>