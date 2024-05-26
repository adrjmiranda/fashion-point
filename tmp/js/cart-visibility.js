const mainContainer = document.querySelector('#main');

const btnShow = document.querySelector('#cart-show');
const btnShowMobile = document.querySelector('#cart-show-mobile');
const btnClose = document.querySelector('#cart-close');

const cart = document.querySelector('#cart');
const cartContent = document.querySelector('#cart-content');

btnShow &&
	btnShowMobile &&
	[btnShow, btnShowMobile].forEach((btn) => {
		btn.addEventListener('click', () => {
			mainContainer.style.overflow = 'hidden';
			cart.style.display = 'flex';
			cartContent.style.opacity = '1';
			cartContent.style.width = '450px';
		});
	});

btnClose &&
	btnClose.addEventListener('click', () => {
		mainContainer.style.overflow = 'visible';
		cart.style.display = 'none';
		cartContent.style.opacity = '0';
		cartContent.style.width = '0';
	});
