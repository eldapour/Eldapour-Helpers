function playAudio() {
    var x = new Audio('src');
    // Show loading animation.
    var playPromise = x.play();

    if (playPromise !== undefined) {
        playPromise.then(_ => {
            x.play();
        })
            .catch(error => {
            });

    }
}