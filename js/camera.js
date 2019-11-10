// declare global variables

let width = 500,
    height = 0,
    filter = "none",
    streaming = false;

// fetching elements from dom

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const clearButton = document.getElementById('clear-button');
const photoButton = document.getElementById('photo-button');
const photoFilter = document.getElementById('photo-filter');


// get the webcam onto the browser

navigator.mediaDevices.getUserMedia({ video: true, audio: false })
    .then(function(stream) {
        video.srcObject = stream;
        video.play();
    })
    .catch(function(err) {
        console.log(`Error: ${err}`);
    });

// play when ready

video.addEventListener('canplay', function(e) {

    if (!streaming) {

        height = video.videoHeight / (video.videoWidth / width);

        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);

        streaming = true;

    }


}, false);

// attaching event to photo button

photoButton.addEventListener('click', function(e) {

    takePicture();

    e.preventDefault();


}, false);

// attaching event to photo filter section

photoFilter.addEventListener('change', function(e) {

    filter = e.target.value;

    video.style.filter = filter;

    e.preventDefault();

});

// event to clear out the photos

clearButton.addEventListener('click', function(e) {
    photos.innerHTML = '';
    canvas.innerHTML = '';
    filter = 'none';
    video.style.filter = filter;
    photoFilter.selectedIndex = 0;
});

// function to take picture

function takePicture() {
    const context = canvas.getContext('2d');

    if (width && height) {
        canvas.width = width;
        canvas.height = height;

        // draw the image of the webcam on the canvas

        context.drawImage(video, 0, 0, width, height);

        const imgUrl = canvas.toDataURL('image/png');

        // create image element

        const img = document.createElement('img');

        // set img src

        img.setAttribute('src', imgUrl);

        img.setAttribute('name', "image");


        img.style.filter = filter;

        photos.appendChild(img);


    }
}

function myCameraUpload() {
    var canvas = document.getElementById("canvas");
    var dataURL = canvas.toDataURL("image/png");
    document.getElementById('hidden_data').value = dataURL;
    var fd = new FormData(document.forms["form1"]);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload_data.php', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
            console.log(percentComplete + '% uploaded');
            alert('Succesfully uploaded');
        }
    };

    xhr.onload = function() {

    };
    xhr.send(fd);
};