<div class="container">
	<div class="filters">
		<ul class="filter-list">
			<li><img src="public/img/filters/owl.png" alt="owl"></li>
			<li><img src="public/img/filters/square_black.png" alt="black square"></li>
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
	<div class="camera">
		<video></video>
	</div>
</div>