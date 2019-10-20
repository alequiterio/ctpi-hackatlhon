navigator.mediaDevices.getUserMedia({video: true, audio: false}).then(  
    
function(stream) {
    const video = document.querySelector("#video");
    video.srcObject = stream;
    video.play();
});



