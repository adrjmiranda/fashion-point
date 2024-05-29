const chooseSessionBtn = document.querySelector('#choose-session');
const chooseSessionBtnClose = document.querySelector('#choose-session-close');
const sessionMenu = document.querySelector('#tabs');

chooseSessionBtn.addEventListener('click', () => {
	sessionMenu.classList.add('visibility');
});

chooseSessionBtnClose.addEventListener('click', () => {
	sessionMenu.classList.remove('visibility');
});
