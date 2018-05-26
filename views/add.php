<div class="container">
	<div class="filters">
		<h2>Choose a frame</h2>
		<ul class="filter-list">
			<li><img class="chosen" src="public/img/filters/hearts.png" alt="owl"></li>
			<li><img class="" src="public/img/filters/green.png" alt="owl"></li>
			<li><img class="" src="public/img/filters/square_black.png" alt="black square"></li>
		</ul>
	</div>
	<form id="add-img" action="add" method="post">
		<label class="editor__uploader" title="Upload picture">
	    	<span class="editor__uploader-inner">
	        <i class="fa fa-picture-o"></i>
	        <i class="fa fa-plus"></i>
	    	</span>
	    	<img id="uploadPreview" />
	    	<input id="upload-image" type="file" accept="image/*" onchange="preview();">
		</label>

		<script type="text/javascript">
    function preview() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("upload-image").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

	</form>
	<div class="camera-container">
		<video id="video"></video>
		<button id="capture" class="btn btn-primary">Take snapshot</button>
		<canvas id="canvas" width="400" height="300"></canvas>
	</div>
</div>