const searchTime = document.querySelector(".time span");
        const searchList = document.querySelector(".search__list");
        const searchAnswers = document.querySelector(".search__answers");
        const searchMissAnswers = document.querySelector(".search__missAnswers");
        const searchStart = document.querySelector(".search__box .start");
        const searchInput = document.querySelector("#search");
        const searchAudio = document.querySelector("#audio");
        const searchAudioBtn = document.querySelector(".search__audio > span");
        const searchScoreTotal = document.querySelector(".search__info .num");
        const searchScoreNow = document.querySelector(".search__info .now");
        const searchResult = document.querySelector(".search__result .result");
        const searchResultWrap = document.querySelector(".search__result");
        const searchRestart = document.querySelector(".search__result .restart");
        let timeReamining = 5,      //남은 시간
            timeInterval = "",
            score = 0,              //점수
            answers = {};           //새로운 정답
        function updateList(){
            cssProperty.forEach(data => {
                searchList.innerHTML += `<span>${data.name}</span>`;
            });
        }
        updateList();
        // 게임 시작하기
        function startQuiz(){
            // 시작 버튼 없애기 & 속성 리스트 없애기
            searchStart.style.display = "none";
            searchList.style.display = "none";
            // 다시 시작할 때 기존 데이터 초기화
            searchAnswers.innerHTML = "";
            searchMissAnswers.innerHTML = "";
            // 시간 설정
            timeInterval = setInterval(reduceTime, 1000);
            // 뮤직 추가하기
            searchAudioBtn.classList.add("playing");
            audio();
            // 점수 계산
            searchScoreTotal.innerText = cssProperty.length;
            // 정답 체크
            checkAnswers();
        }
        // 음악 설정
        function audio(){
            searchAudioBtn.addEventListener("click", () => {
                searchAudioBtn.classList.toggle("playing");
                if(searchAudioBtn.classList.contains("playing")){
                    searchAudio.play();
                } else {
                    searchAudio.pause();
                }
            })
            searchAudio.play();
        }
        // 인풋 체크하기
        function checkInput(){
            let input = event.currentTarget.value.trim().toLowerCase();
            if(answers.hasOwnProperty(input) && !answers[input]){
                answers[input] = true;
                //정답 표시
                searchAnswers.style.display = "block";
                searchAnswers.innerHTML += `<span>${input}</span>`;
                //점수 반영
                score++;
                searchScoreNow.innerText = score;
                //정답 초기화
                searchInput.value = "";
            }
        }
        // 정답 체크하기 : 정답을 객체 파일로 만들기
        function checkAnswers(){
            cssProperty.forEach(item => {
                let answer = item.name.trim().toLocaleLowerCase();
                answers[answer] = false;
            });
            console.log(answers)
        }
        // 오답 보여주기
        function missAnswers(){
            searchMissAnswers.style.display = "block";
            cssProperty.forEach(item => {
                let answer = item.name.trim().toLocaleLowerCase();
                if(!answers[answer]){
                    searchMissAnswers.innerHTML += `<span>${answer}</span>`;
                }
            });
        }
        // 시간 설정하기
        function reduceTime(){
            timeReamining--;
            if(timeReamining == 0) endQuiz();
            searchTime.innerText = displayTime();
        }
        // 시간 표시하기
        function displayTime(){
            if(timeReamining <= 0){
                return "0:00";
            } else {
                let minutes = Math.floor(timeReamining / 60);
                let seconds = timeReamining % 60;
                //초 단위가 한자리수 일 때 0을 추가
                if( seconds < 10 ) seconds = "0" + seconds;
                return minutes + ":" + seconds;
            }
        }
        // 게임 끝났을 때
        function endQuiz(){
            // alert("게임이 끝났습니다.!!!");
            // 시작 버튼 만들기
            searchStart.style.display = "block";
            searchStart.style.pointerEvents = "none";
            // 오답 보여주기
            missAnswers();
            // 음악 끄기
            searchAudio.pause();
            searchAudioBtn.classList.remove("playing");
            // 시간 정지
            clearInterval(timeInterval);
            // 메세지 출력
            searchResultWrap.classList.add("show");
            let point = Math.round((score / cssProperty.length) * 100);
            searchResult.innerHTML = `게임이 끝났습니다.<br> 당신은 ${cssProperty.length} 개중에 ${score} 개를 맞추었습니다.<br> 당신의 점수는 몇 ${point}점입니다.`;
        }
        // 다시 시작하기
        function restart(){
            searchResultWrap.classList.remove("show");
            searchAudioBtn.classList.remove("playing");
            searchAudio.play();
            startQuiz();
            timeReamining = 120;
            score = 0;
            searchScoreNow.innerText = "0";
        }
        // 버튼 이벤트
        searchStart.addEventListener("click", startQuiz);
        searchInput.addEventListener("input", checkInput);
        searchRestart.addEventListener("click", restart);