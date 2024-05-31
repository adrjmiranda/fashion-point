const mobileMenu = document.querySelector('#mobile-menu');
const toggleMenu = document.querySelector('#toggle-menu');

toggleMenu &&
	mobileMenu &&
	toggleMenu.addEventListener('click', () => {
		mobileMenu.classList.toggle('toggle-visibility');
	});
