window.onload = function() {
  let constraints = {
  	video: {width: 600, height: 380}
  };

  navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream) {
  	let video = document.querySelector('video');
  	video.srcObject = mediaStream;
  	video.onloadedmetadata = function(e) {
        video.play();
    };
  	let form = document.getElementById('add-img');
  	form.style.display = "none";
  }).catch(function(err) { console.log(err.name + ": " + err.message); });
};