const allMusic = [
    {
        name: "Funny Dream1",
        artlist: "Royalty-free Music",
        img: "music-1",
        audio: "music-1",
    },

    {
        name: "Cinematic and Emotional2",
        artlist: "Documentary",
        img: "music-2",
        audio: "music-2",
    },

    {
        name: "Copyright3",
        artlist: "YouTube Videos",
        img: "music-3",
        audio: "music-3",
    },

    {
        name: "Free Corporate Background4",
        artlist: "Presentations",
        img: "music-4",
        audio: "music-4",
    },

    {
        name: "Free Corporate Background Music5",
        artlist: "UNKNOWN",
        img: "music-5",
        audio: "music-5",
    },

    {
        name: "Free Relaxing Music Playlist6",
        artlist: "UNKNOWN",
        img: "music-6",
        audio: "music-6",
    },

    {
        name: "Inspirational Background Music7",
        artlist: "Presentation",
        img: "music-7",
        audio: "music-7",
    },

    {
        name: "Instrumental Music for Inspirational8",
        artlist: "YouTube",
        img: "music-8",
        audio: "music-8",
    },

    {
        name: "Jingle Bells for Kids Instrumental9",
        artlist: "UNKNOWN",
        img: "music-9",
        audio: "music-9",
    },

    {
        name: "Kygo10",
        artlist: "Conrad Firestone",
        img: "music-10",
        audio: "music-10",
    },

    {
        name: "Motivational Background Music11",
        artlist: "Instrumental",
        img: "music-11",
        audio: "music-11",
    },

    {
        name: "Powerful Background Presentation Music12",
        artlist: "Royalty Free",
        img: "music-12",
        audio: "music-12",
    },
];

const musicWrap = document.querySelector(".music__wrap");
const musicView = musicWrap.querySelector(".music__view .img img");

const musicName = musicWrap.querySelector(".music__view .title h3");
const musicArtlist = musicWrap.querySelector(".music__view .title p");
const musicAudio = musicWrap.querySelector("#main-audio");

const musicPlay = musicWrap.querySelector("#control-play");
const musicPrev = musicWrap.querySelector("#control-prev");
const musicNext = musicWrap.querySelector("#control-next");
const musicRepeat = musicWrap.querySelector("#control-repeat");

const musicProgress = musicWrap.querySelector(".progress");
const musicProgressBar = musicWrap.querySelector(".progress .bar");
const musicProgressCurrent = musicWrap.querySelector(".progress .timer .current");
const musicProgressDuration = musicWrap.querySelector(".progress .timer .duration");

const musicVol = musicWrap.querySelector(".vol");
const musicVolBar = musicWrap.querySelector(".vol .bar");
const musicVolDown = musicWrap.querySelector(".vol .volum .down");
const musicVolUp = musicWrap.querySelector(".vol .volum .up");

const musicListBtn = musicWrap.querySelector("#control-list");

const musicList = document.querySelector(".music__list");
const musicListUl = document.querySelector(".music__list Ul");

let musicIndex = 1;
let musicCount = allMusic.length;

musicListBtn.addEventListener("click", () => {
    if (musicList.getAttribute("class").includes("show")) {
        musicList.classList.remove("show");
    } else musicList.classList.add("show");

    document.querySelector(".music__list h3 .close").addEventListener("click", () => {
        musicList.classList.remove("show");
    });
});

//?????? ??????
function playMusic() {
    musicAudio.play();
    musicWrap.classList.add("paused");
    musicPlay.setAttribute("title", "??????");
    musicPlay.setAttribute("class", "stop");
}
//????????????
function pauseMusic() {
    musicAudio.pause();
    musicWrap.classList.remove("paused");
    musicPlay.setAttribute("title", "??????");
    musicPlay.setAttribute("class", "play");
}

//?????? ??? ?????? ??????
function prevMusic() {
    // let musicInx = (musicIndex + musicCount - 1) % musicCount;
    musicIndex == 1 ? (musicIndex = allMusic.length) : musicIndex--;
    loadMusic(musicIndex);
    playMusic();
}

//?????? ??? ?????? ??????
function nextMusic() {
    musicIndex == allMusic.length ? (musicIndex = 1) : musicIndex++;
    loadMusic(musicIndex);
    playMusic();
}
//????????? ??????
musicPlay.addEventListener("click", () => {
    const isMusicPauesd = musicWrap.classList.contains("paused");
    isMusicPauesd ? pauseMusic() : playMusic();
});

//?????? ?????????
musicAudio.addEventListener("timeupdate", (e) => {
    const currentTime = e.target.currentTime; // ???????????? ?????? ??????
    const duration = e.target.duration; // ???????????? ?????? ??????
    let progressWidth = (currentTime / duration) * 100; // ?????? ???????????? ?????? ???????????? ????????? ???????????? ??????
    musicProgressBar.style.width = `${progressWidth}%`;

    //?????? ??????
    let currentMin = Math.floor(currentTime / 60);
    let currentSec = Math.floor(currentTime % 60);
    if (currentSec < 10) currentSec = `0${currentSec}`;
    musicProgressCurrent.innerText = `${currentMin}:${currentSec}`;

    //?????? ??????
    musicAudio.addEventListener("loadeddata", () => {
        let audioDuration = musicAudio.duration;
        let totalMin = Math.floor(audioDuration / 60); // ?????? ?????????(???) ???????????? ??????
        let totalSec = Math.floor(audioDuration % 60); // ?????? ??????
        if (totalSec < 10) totalSec = `0${totalSec}`; //?????? ?????????????????? ??????????????? ??????
        musicProgressDuration.innerText = `${totalMin}:${totalSec}`;
    });
});

// ?????? ?????? ??????
musicProgress.addEventListener("click", (e) => {
    let progressWidth = musicProgress.clientWidth; //????????? ????????????
    let clickedOffsetX = e.offsetX; //????????? ???????????? ???????????? X??????
    let songDuration = musicAudio.duration; //????????? ????????????
    musicAudio.currentTime = (clickedOffsetX / progressWidth) * songDuration; // ???????????? ?????? ????????? ?????? ?????? ????????? ????????? ?????? ??????????????? ??????
});
musicAudio.volume = 0.1;

musicVol.addEventListener("click", (e) => {
    let volWidth = musicVol.clientWidth;
    let clickedOffsetX = e.offsetX;
    console.log(clickedOffsetX / volWidth);
    musicAudio.volume = clickedOffsetX / volWidth;
    let musicCurrent = Math.floor(musicAudio.volume * 100);
    musicVolBar.style.width = `${musicCurrent}%`;
    if (musicCurrent < 10) musicCurrent = `0${musicCurrent}`;
    musicVolDown.innerText = `${musicCurrent}`;
});

// ?????? ?????? ??????
musicRepeat.addEventListener("click", () => {
    let getAttr = musicRepeat.getAttribute("class");
    switch (getAttr) {
        case "repeat":
            musicRepeat.setAttribute("class", "repeat_one");
            musicRepeat.setAttribute("title", "?????? ??????");
            break;
        case "repeat_one":
            musicRepeat.setAttribute("class", "shuffle");
            musicRepeat.setAttribute("title", "?????? ??????");
            break;
        case "shuffle":
            musicRepeat.setAttribute("class", "repeat");
            musicRepeat.setAttribute("title", "?????? ??????");
            break;
    }
});

// ????????? ??????
musicPrev.addEventListener("click", () => {
    prevMusic();
    playListMusic();
});
//????????? ??????
musicNext.addEventListener("click", () => {
    nextMusic();
    playListMusic();
});
window.addEventListener("load", () => {
    loadMusic(musicIndex);
});

//???????????? ?????????
musicAudio.addEventListener("ended", () => {
    let getAttr = musicRepeat.getAttribute("class");
    switch (getAttr) {
        case "repeat":
            nextMusic();
            playListMusic();
            break;
        case "repeat_one":
            playMusic();
            break;
        case "shuffle":
            let randomIndex = Math.floor(Math.random() * allMusic.length + 1); //?????? ?????????
            do {
                randomIndex = Math.floor(Math.random() * allMusic.length + 1); //?????? ?????????
            } while (musicIndex == randomIndex); // ?????????????????? ?????????????????? ??????????????? ??????
            musicIndex = randomIndex; // ??????????????? ??????
            loadMusic(musicIndex);
            playMusic();
            playListMusic();
            break;
    }
});

//?????? ????????? ??????
for (let i = 0; i < allMusic.length; i++) {
    let li = `<li data-index="${i + 1}">
                  <strong>${allMusic[i].name}</strong>
                  <em>${allMusic[i].artlist}</em>
                  <audio class="${allMusic[i].audio}" src="../assets/audio/${allMusic[i].audio}.mp3"></audio>
                  <span class="audio-duration" id="${allMusic[i].audio}"></span>
              </li>`;
    // musicListUl.innerHTML += li;
    musicListUl.insertAdjacentHTML("beforeend", li);
    //???????????? ?????? ?????? ????????????
    let liAudioDuration = musicListUl.querySelector(`#${allMusic[i].audio}`); //??????????????? ????????? ????????? ???????????? ?????????
    let liAudio = musicListUl.querySelector(`.${allMusic[i].audio}`); //??????????????? ???????????? ?????????

    liAudio.addEventListener("loadeddata", () => {
        let audioDuration = liAudio.duration;
        let totalMin = Math.floor(audioDuration / 60); // ?????? ?????????(???) ???????????? ??????
        let totalSec = Math.floor(audioDuration % 60); // ?????? ??????
        if (totalSec < 10) totalSec = `0${totalSec}`; //?????? ?????????????????? ??????????????? ??????
        liAudioDuration.innerText = `${totalMin}:${totalSec}`;
        liAudioDuration.setAttribute("data-duration", `${totalMin}:${totalSec}`); //????????? ????????? ?????? ??????
    });
}

// ?????? ????????? ???????????? ??????
function playListMusic() {
    const musicListAll = musicListUl.querySelectorAll("li"); // ?????? ????????? ??????
    for (let i = 0; i < musicListAll.length; i++) {
        let audioTag = musicListAll[i].querySelector(".audio-duration"); //?????????
        if (musicListAll[i].classList.contains("playing")) {
            //playing ????????????????????? ??????
            musicListAll[i].classList.remove("playing"); //????????? ??????
            let addDuration = audioTag.getAttribute("data-duration"); // data??????????????? duration ??? ?????????
            audioTag.innerText = addDuration; //??????
        }
        if (musicListAll[i].getAttribute("data-index") == musicIndex) {
            //data??????????????? index ??? music ???????????? ???????????????
            musicListAll[i].classList.add("playing"); // ????????? ??????
            audioTag.innerText = "?????????"; //????????? ??????
        }
        musicListAll[i].setAttribute("onclick", "clicked(this)");
    }
}
playListMusic();
//?????? ???????????? ????????????..
function clicked(el) {
    let getLiIndex = el.getAttribute("data-index"); //????????? ???????????? ??????
    musicIndex = getLiIndex; //???????????? ?????????
    loadMusic(musicIndex); //????????? ?????????????????? ??????
    playMusic(); //????????????
    playListMusic(); //????????????
}

//?????? ??????
function loadMusic(num) {
    musicName.innerText = allMusic[num - 1].name; //?????? ?????? ??????
    musicArtlist.innerText = allMusic[num - 1].artlist; //?????? ???????????? ??????
    musicView.src = `../assets/img/${allMusic[num - 1].img}.png`; //?????? ????????? ??????
    musicView.alt = allMusic[num - 1].name; //?????? ?????????alt ??????
    musicAudio.src = `../assets/audio/${allMusic[num - 1].audio}.mp3`; //?????? ??????
}

// musicPlay.addEventListener("click", () => {
//     if (musicPlay.classList == "play") {
//         playMusic();
//         musicPlay.classList.remove("play");
//         musicPlay.title = "??????";
//         musicPlay.classList.add("stop");
//     } else if (musicPlay.classList == "stop") {
//         stopMusic();
//         musicPlay.classList.remove("stop");
//         musicPlay.title = "??????";
//         musicPlay.classList.add("play");
//     }
// });
