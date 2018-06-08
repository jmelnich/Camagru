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
	<div class="container-flex">
		<div class="container-capture">
			<h2>Add something new!</h2>
			<hr>
				<ul class="filter-list" id="filter-list">
					<li><img class="faded" src="public/img/filters/hearts.png" alt="hearts frame"></li>
					<li><img class="faded" src="public/img/filters/lady-hat.png" alt="lady hat"></li>
					<li><img class="faded" src="public/img/filters/hat1.png" alt="hat"></li>
					<li><img class="faded" src="public/img/filters/magic-hat.png" alt="magic hat"></li>
					<li><img class="faded" src="public/img/filters/deer.png" alt="deer horns"></li>
				</ul>
			<div class="img-action">
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
			<div class="canvas-container">
				<canvas id="canvas"></canvas>
			</div>
		</div>
	</div>
	</div>
</div>
		<script src="public/js/filters.js"></script>
		<script type="module" src="public/js/constants.js"></script>
	    <script type="module" src="public/js/camera.js"></script>
	    <script type="module" src="public/js/button.js"></script>
	    <script type="module" src="public/js/image.js"></script>
	    <script type="module" src="public/js/post.js"></script>
	    <script type="module" src="public/js/Frame.js"></script>

