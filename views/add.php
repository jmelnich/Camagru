<?php
$user = new UserModel();
if ($user->isLoggedIn()) {
    $uid = $user->data()->id;
    $recent_posts = new PostModel();
    $recent_posts = $recent_posts->getRecent($uid, 10);
} else {
	header('Location: 404');
}?>
<div class="container">
	<div class="form">
	<div class="container-flex-between">
		<div class="container-capture">
			<h2>Add something new!</h2>
			<hr>

				<h3>Choose a frame</h3>
				<ul class="filter-list" id="filter-list">
					<li><img class="faded" src="public/img/filters/hearts.png" alt="owl"></li>
					<li><img class="faded" src="public/img/filters/green.png" alt="owl"></li>
					<li><img class="faded" src="public/img/filters/square_black.png" alt="black square"></li>
				</ul>

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
			<div class="canvas-container">
				<canvas id="canvas" width="600" height="450"></canvas>
			</div>
		</div>

		<div class="container-gallery">
			<h2>Your latest photos</h2>
			<hr>
			<ul class="gallery-list">
			<?php
			foreach ($recent_posts as $rpost) {
			?>
				<li><img class="thumb" src="../<?php echo escape($rpost['isrc']);?>" alt=""></li>
			<?php } ?>
			</ul>
		</div>
	</div>
	</div>
</div>
		<script src="public/js/filters.js"></script>
		<script type="module" src="public/js/constants.js"></script>
	    <script type="module" src="public/js/canvas.js"></script>
	    <script type="module" src="public/js/camera.js"></script>
	    <script type="module" src="public/js/button.js"></script>
	    <script type="module" src="public/js/image.js"></script>
	    <script type="module" src="public/js/post.js"></script>

