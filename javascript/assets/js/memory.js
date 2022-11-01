// 01 HTML CSS 구성
// 02 클릭한 카드 뒤집기
// 03 두개의 카드 뒤집기 확인하기
const memoryWrap = document.querySelector(".memory__wrap");
const memoryCards = memoryWrap.querySelectorAll(".cards li");
const memoryResult = document.querySelector(".memory__result");

let cardOne, cardTwo;
let disableDeck = false;
let matchedCard = 0;

let sound = ["../assets/audio/match.mp3", "../assets/audio/unmatch.mp3", "../assets/audio/success.mp3"];

let soundMatch = new Audio([sound[0]]);
let soundUnMatch = new Audio([sound[1]]);
let soundSuccess = new Audio([sound[2]]);
let timeresult = -4;
let memoriScore = 100;
let interval;

// 카드 뒤집기
function flipCard(e) {
	let clickedCard = e.target;

	if (clickedCard !== cardOne && !disableDeck) {
		clickedCard.classList.add("flip");

		if (!cardOne) {
			return (cardOne = clickedCard);
		}
		cardTwo = clickedCard;
		disableDeck = true;

		let cardOneImg = cardOne.querySelector(".back img").src;
		let cardTwoImg = clickedCard.querySelector(".back img").src;

		matchCards(cardOneImg, cardTwoImg);
	}
}
//카드 확인
function matchCards(img1, img2) {
	if (img1 == img2) {
		matchedCard++;
		soundMatch.play();
		cardOne.removeEventListener("click", flipCard);
		cardTwo.removeEventListener("click", flipCard);
		cardOne = cardTwo = "";
		disableDeck = false;
		if (matchedCard == 8) {
			soundSuccess.play();
			clearInterval(interval);
			memoryResult.classList.add("open");
			textResult();
		}
	} else {
		console.log("틀리다");

		setTimeout(() => {
			cardOne.classList.add("shakeX");
			cardTwo.classList.add("shakeX");
		}, 600);

		setTimeout(() => {
			cardOne.classList.remove("shakeX");
			cardTwo.classList.remove("shakeX");
			cardOne.classList.remove("flip");
			cardTwo.classList.remove("flip");
			soundUnMatch.play();
			cardOne = cardTwo = "";
			disableDeck = false;
		}, 1600);
	}
}

// 카드 섞기
function shuffledCard(params) {
	cardOne = cardTwo = "";
	disableDeck = true;
	matchedCard = 0;
	timeresult = -5;
	let arr = [1, 2, 3, 4, 5, 6, 7, 8, 1, 2, 3, 4, 5, 6, 7, 8];
	let result = arr.sort(() => (Math.random() > 0.5 ? 1 : -1));

	memoryCards.forEach((card, index) => {
		card.classList.remove("flip");
	});
	setTimeout(() => {
		memoryCards.forEach((card, index) => {
			setTimeout(() => {
				card.classList.add("flip");
			}, 200 * index);

			setTimeout(() => {
				card.classList.remove("flip");
				disableDeck = false;
			}, 4000);

			let imgTag = card.querySelector(".back img");
			imgTag.src = `../assets/img/gameimage/img-${arr[index]}.svg`;

			card.addEventListener("click", flipCard);
		});
	}, 1000);
	interval = setInterval(() => {
		timeresult++;
		console.log(timeresult);
		if (timeresult > 10) {
			memoriScore--;
		}
	}, 1000);
}

function textResult() {
	let currentMin = Math.floor(timeresult / 60);
	let currentSec = Math.floor(timeresult % 60);
	let reultTime = timeresult;

	if (currentMin > 0) {
		document.querySelector(".memory__time").innerHTML = `총 <em>${currentMin}</em> 분 <em>${currentSec}</em> 초가 걸렸습니다.`;
	} else document.querySelector(".memory__time").innerHTML = `총 <em>${currentSec}</em> 초가 걸렸습니다.`;

	if (memoriScore >= 90) {
		document.querySelector(".memory__grade").innerText = memoriScore;
		document.querySelector(".memory__rank").innerHTML = "당신은 <em>S</em> 등급 입니다</span>";
	} else if (80 <= memoriScore && memoriScore < 90) {
		document.querySelector(".memory__grade").innerText = memoriScore;
		document.querySelector(".memory__rank").innerHTML = "당신은 <em>A</em> 등급 입니다</span>";
	} else if (70 <= memoriScore && memoriScore < 80) {
		document.querySelector(".memory__grade").innerText = memoriScore;
		document.querySelector(".memory__rank").innerHTML = "당신은 <em>B</em> 등급 입니다</span>";
	} else if (60 <= memoriScore && memoriScore < 70) {
		document.querySelector(".memory__grade").innerText = memoriScore;
		document.querySelector(".memory__rank").innerHTML = "당신은 <em>C</em> 등급 입니다</span>";
	} else if (50 <= memoriScore && memoriScore < 60) {
		document.querySelector(".memory__grade").innerText = memoriScore;
		document.querySelector(".memory__rank").innerHTML = "당신은 <em>D</em> 등급 입니다</span>";
	} else {
		document.querySelector(".memory__grade").innerText = memoriScore;
		document.querySelector(".memory__rank").innerHTML = "당신은 <em>F</em> 등급 입니다</span>";
	}
}

// 카드 클릭
// memoryCards.forEach(card => {
// 	card.addEventListener("click", flipCard);
// });

document.querySelector(".memory__replay").addEventListener("click", () => {
	memoryResult.classList.remove("open");
	setTimeout(() => {
		shuffledCard();
	}, 700);
});

document.querySelector(".memory__bye").addEventListener("click", () => {
	memoryResult.classList.remove("open");
	document.querySelector(".memory__wrap").classList.remove("open");
});
