//form received//
function openForm(){
document.getElementById("RegForm").style.display = "block";
}
function closeForm(){
document.getElementById("RegForm").style.display = "none";
}

var modal = document.getElementById("RegForm");

//when user clicks anywhere outside of the modal/form, close it!--------//
window.onclick = function(event){
if(event.target == modal){
    modal.style.display = "none";
    }
}

//wait until page load is finish
window.addEventListener('load', function(){
    const popup = document.querySelector(".modal-pop");
    //checks if home popup has already been displayed (100%)
    if(!this.localStorage.getItem('popupDisplayed')){
        setTimeout(function(){
            popup.classList.add("modal-show");
        },3000); 
        //stored in local storage to prevent trigger on page load
        this.localStorage.setItem('popupDisplayed', true);
        document.querySelector("#ending").addEventListener("click", () =>{
            popup.classList.remove("modal-show");
            popup.classList.add("modal-hide");
        })
    }
})

function delayAutoplay(){
    var video = document.getElementById("video-delay");    //Get video element
    video.pause();     //pasue video
    //Set timeout to play video after delay

    setTimeout(function(){
        video.play();
    }, 5000); //Delay timer
}
//Call delay function when window loads
window.onload = function(){
    delayAutoplay();
    autoplayStaller();
    watchDog();
}

function autoplayStaller(){
    var video = document.getElementById("video-delay1");   
    video.pause();   

    setTimeout(function(){
        video.play();
    }, 130000); //Delay timer
}

function watchDog(){
    var video = document.getElementById("video-delay2");   
    video.pause();   

    setTimeout(function(){
        video.play();
    }, 255000); //Delay timer
}

const videoClock = document.querySelectorAll(".video-bar");
//Play video on window load
videoClock.forEach(video => {
    video.addEventListener("play", () => {      //Code controls when video is played
        stopVideoPlay(video);
    });
})

//Function to restart video
videoClock.forEach(video => {
    video.addEventListener("ended", () => {  //Code listens for 'ended' to restart video in caruosel loop
        video.currentTime = 0;             //Reset video time to 0 when stopped
        video.play();
    });
})

//Function to stop video
function stopVideoPlay(videoPlayer){
    videoClock.forEach(video => {
        if(video !== videoPlayer && !video.paused){
            video.pause();      //Prevents video from playing behind another in slider
        }
    })
}






