const clickImgs = document.querySelectorAll('.asideBtn');
const iDolImgs = document.querySelectorAll('.article');

iDolImgs.forEach((idol) => {
    idol.style.display = 'none';
});
iDolImgs[0].style.display = 'block';

clickImgs.forEach((clickImg, inx) => {
    clickImg.addEventListener('click', () => {
        iDolImgs.forEach((idol) => {
            idol.style.display = 'none';
        });
        iDolImgs[inx].style.display = 'block';
    });
});

iDolImgs.forEach((idol) => {
    idol.querySelector('.articleImg img').addEventListener('mouseover', (e) => {
        idol.querySelector('.desc').style.opacity = 0;
        idol.querySelector('.imgInfo').style.opacity = 1;
    });
    idol.querySelector('.articleImg img').addEventListener('mouseleave', (e) => {
        idol.querySelector('.imgInfo').style.opacity = 0;
        idol.querySelector('.desc').style.opacity = 1;
    });
});
