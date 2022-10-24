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

//재생 버튼
function playMusic() {
    musicAudio.play();
    musicWrap.classList.add("paused");
    musicPlay.setAttribute("title", "정지");
    musicPlay.setAttribute("class", "stop");
}
//정지버튼
function pauseMusic() {
    musicAudio.pause();
    musicWrap.classList.remove("paused");
    musicPlay.setAttribute("title", "재생");
    musicPlay.setAttribute("class", "play");
}

//이전 곡 듣기 버튼
function prevMusic() {
    // let musicInx = (musicIndex + musicCount - 1) % musicCount;
    musicIndex == 1 ? (musicIndex = allMusic.length) : musicIndex--;
    loadMusic(musicIndex);
    playMusic();
}

//다음 곡 듣기 버튼
function nextMusic() {
    musicIndex == allMusic.length ? (musicIndex = 1) : musicIndex++;
    loadMusic(musicIndex);
    playMusic();
}
//플레이 버튼
musicPlay.addEventListener("click", () => {
    const isMusicPauesd = musicWrap.classList.contains("paused");
    isMusicPauesd ? pauseMusic() : playMusic();
});

//뮤직 진행바
musicAudio.addEventListener("timeupdate", (e) => {
    const currentTime = e.target.currentTime; // 오디오의 현재 시간
    const duration = e.target.duration; // 오디오의 전체 시간
    let progressWidth = (currentTime / duration) * 100; // 전체 길이에서 현재 진행되는 시간을 백분위로 나눔
    musicProgressBar.style.width = `${progressWidth}%`;

    //진행 시간
    let currentMin = Math.floor(currentTime / 60);
    let currentSec = Math.floor(currentTime % 60);
    if (currentSec < 10) currentSec = `0${currentSec}`;
    musicProgressCurrent.innerText = `${currentMin}:${currentSec}`;

    //전체 시간
    musicAudio.addEventListener("loadeddata", () => {
        let audioDuration = musicAudio.duration;
        let totalMin = Math.floor(audioDuration / 60); // 전체 시간을(초) 분단위로 조정
        let totalSec = Math.floor(audioDuration % 60); // 남은 시간
        if (totalSec < 10) totalSec = `0${totalSec}`; //초가 한자리수일때 두자리수로 만듬
        musicProgressDuration.innerText = `${totalMin}:${totalSec}`;
    });
});

// 진행 버튼 클릭
musicProgress.addEventListener("click", (e) => {
    let progressWidth = musicProgress.clientWidth; //진행바 전체길이
    let clickedOffsetX = e.offsetX; //진행바 기준으로 측정되는 X좌표
    let songDuration = musicAudio.duration; //오디오 전체길이
    musicAudio.currentTime = (clickedOffsetX / progressWidth) * songDuration; // 백분위로 나눈 숫자에 다시 전체 길이를 곱해서 현재 재생값으로 바꿈
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

// 반복 버튼 클릭
musicRepeat.addEventListener("click", () => {
    let getAttr = musicRepeat.getAttribute("class");
    switch (getAttr) {
        case "repeat":
            musicRepeat.setAttribute("class", "repeat_one");
            musicRepeat.setAttribute("title", "한곡 반복");
            break;
        case "repeat_one":
            musicRepeat.setAttribute("class", "shuffle");
            musicRepeat.setAttribute("title", "랜덤 재생");
            break;
        case "shuffle":
            musicRepeat.setAttribute("class", "repeat");
            musicRepeat.setAttribute("title", "전체 반복");
            break;
    }
});

// 이전곡 재생
musicPrev.addEventListener("click", () => {
    prevMusic();
    playListMusic();
});
//다음곡 재생
musicNext.addEventListener("click", () => {
    nextMusic();
    playListMusic();
});
window.addEventListener("load", () => {
    loadMusic(musicIndex);
});

//오디오가 끝나면
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
            let randomIndex = Math.floor(Math.random() * allMusic.length + 1); //랜덤 인덱스
            do {
                randomIndex = Math.floor(Math.random() * allMusic.length + 1); //랜덤 인덱스
            } while (musicIndex == randomIndex); // 뮤직인덱스와 랜덤인덱스가 같지않을때 변경
            musicIndex = randomIndex; // 랜덤인덱스 넣기
            loadMusic(musicIndex);
            playMusic();
            playListMusic();
            break;
    }
});

//뮤직 리스트 구현
for (let i = 0; i < allMusic.length; i++) {
    let li = `<li data-index="${i + 1}">
                  <strong>${allMusic[i].name}</strong>
                  <em>${allMusic[i].artlist}</em>
                  <audio class="${allMusic[i].audio}" src="../assets/audio/${allMusic[i].audio}.mp3"></audio>
                  <span class="audio-duration" id="${allMusic[i].audio}"></span>
              </li>`;
    // musicListUl.innerHTML += li;
    musicListUl.insertAdjacentHTML("beforeend", li);
    //리스트에 음악 시간 불러오기
    let liAudioDuration = musicListUl.querySelector(`#${allMusic[i].audio}`); //리스트에서 시간을 표시할 선택자를 가져옴
    let liAudio = musicListUl.querySelector(`.${allMusic[i].audio}`); //리스트에서 오디오를 가져옴

    liAudio.addEventListener("loadeddata", () => {
        let audioDuration = liAudio.duration;
        let totalMin = Math.floor(audioDuration / 60); // 전체 시간을(초) 분단위로 조정
        let totalSec = Math.floor(audioDuration % 60); // 남은 시간
        if (totalSec < 10) totalSec = `0${totalSec}`; //초가 한자리수일때 두자리수로 만듬
        liAudioDuration.innerText = `${totalMin}:${totalSec}`;
        liAudioDuration.setAttribute("data-duration", `${totalMin}:${totalSec}`); //속성에 오디오 길이 기록
    });
}

// 뮤직 리스트 클릭하면 재생
function playListMusic() {
    const musicListAll = musicListUl.querySelectorAll("li"); // 뮤직 리스트 목록
    for (let i = 0; i < musicListAll.length; i++) {
        let audioTag = musicListAll[i].querySelector(".audio-duration"); //선택자
        if (musicListAll[i].classList.contains("playing")) {
            //playing 클래스가있는지 확인
            musicListAll[i].classList.remove("playing"); //있으면 삭제
            let addDuration = audioTag.getAttribute("data-duration"); // data속성에있는 duration 를 가져옴
            audioTag.innerText = addDuration; //추가
        }
        if (musicListAll[i].getAttribute("data-index") == musicIndex) {
            //data속성에있는 index 가 music 인덱스가 맞는지확인
            musicListAll[i].classList.add("playing"); // 클래스 추가
            audioTag.innerText = "재생중"; //텍스트 추가
        }
        musicListAll[i].setAttribute("onclick", "clicked(this)");
    }
}
playListMusic();
//뮤직 리스트를 클릭하면..
function clicked(el) {
    let getLiIndex = el.getAttribute("data-index"); //클릭한 인데스값 저장
    musicIndex = getLiIndex; //인데스값 전해줌
    loadMusic(musicIndex); //받아온 인덱스값으로 변경
    playMusic(); //음악시작
    playListMusic(); //음악보기
}

//음악 재생
function loadMusic(num) {
    musicName.innerText = allMusic[num - 1].name; //뮤직 이름 로드
    musicArtlist.innerText = allMusic[num - 1].artlist; //뮤직 아티스트 로드
    musicView.src = `../assets/img/${allMusic[num - 1].img}.png`; //뮤직 이미지 로드
    musicView.alt = allMusic[num - 1].name; //뮤직 이미지alt 로드
    musicAudio.src = `../assets/audio/${allMusic[num - 1].audio}.mp3`; //뮤직 로드
}

// musicPlay.addEventListener("click", () => {
//     if (musicPlay.classList == "play") {
//         playMusic();
//         musicPlay.classList.remove("play");
//         musicPlay.title = "정지";
//         musicPlay.classList.add("stop");
//     } else if (musicPlay.classList == "stop") {
//         stopMusic();
//         musicPlay.classList.remove("stop");
//         musicPlay.title = "재생";
//         musicPlay.classList.add("play");
//     }
// });
