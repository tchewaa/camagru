const video = document.getElementById('video');
const canvas = document.getElementById('edit');
const snap = document.getElementById('snap');
const apply = document.getElementById('apply');
const kya = document.getElementById('kya');
const light = document.getElementById('light');
const nerd = document.getElementById('nerd');
const skull = document.getElementById('skull');

runCamera();

function runCamera() {

    var constrains = {
        video: { width: 416, height: 300 }
    };
    navigator.mediaDevices.getUserMedia(constrains).then(stream => {
        video.srcObject = stream;
    });
}

var context = canvas.getContext('2d');
snap.addEventListener("click", function () {
    context.drawImage(video, 0, 0, 416, 300);
});

apply.addEventListener("click", function() {
    var x = document.getElementById('stickers').value;
    if (x == "kya")
        context.drawImage(kya, 50, 50, 80, 80);
    else if (x == "light")
        context.drawImage(light, 80, 20, 80, 80);
    else if (x == "nerd")
        context.drawImage(nerd, 20, 80, 80, 80);
    else if (x == "skull")
        context.drawImage(skull, 20, 80, 80, 80);
    else
        context.drawImage(video, 0, 0, 416, 300);
})
var save = document.getElementById("save");

save.addEventListener("click", function () {

    var data = "img=" + canvas.toDataURL();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("success");
            location.reload();
        }
    };
    xhttp.open("POST", "upload_data.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);

});

