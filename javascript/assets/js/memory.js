// 01 HTML CSS 구성
// 02 클릭한 카드 뒤집기
// 03 두개의 카드 뒤집기 확인하기
const memoryWrap = document.querySelector(".memory__wrap");
const memoryCards = memoryWrap.querySelectorAll(".cards li");
let cardOne, cardTwo;
let disableDeck = false;
let matchedCard = 0;

let sound = ["../assets/audio/match.mp3", "../assets/audio/unmatch.mp3", "../assets/audio/success.mp3"];

let soundMatch = new Audio([sound[0]]);
let soundUnMatch = new Audio([sound[1]]);
let soundSuccess = new Audio([sound[2]]);

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
		console.log("같다");
		cardOne.removeEventListener("click", flipCard);
		cardTwo.removeEventListener("click", flipCard);
		cardOne = cardTwo = "";
		disableDeck = false;
		if (matchedCard == 8) {
			soundSuccess.play();
			alert("게임 오버");
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
	cardone = cardTwo = "";
	disableDeck = false;
	matchCard = 0;

	let arr = [1, 2, 3, 4, 5, 6, 7, 8, 1, 2, 3, 4, 5, 6, 7, 8];
	let result = arr.sort(() => (Math.random() > 0.5 ? 1 : -1));

	memoryCards.forEach((card, index) => {
		card.classList.remove("flip");

		setTimeout(() => {
			card.classList.add("flip");
		}, 200 * index);

		setTimeout(() => {
			card.classList.remove("flip");
		}, 4000);

		let imgTag = card.querySelector(".back img");
		imgTag.src = `../assets/img/gameimage/img-${arr[index]}.svg`;
	});
}

// 카드 클릭
memoryCards.forEach(card => {
	card.addEventListener("click", flipCard);
});
