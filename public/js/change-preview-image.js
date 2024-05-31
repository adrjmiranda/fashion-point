const imgPrev = document.querySelector('#main-img');
const thumbnails = document.querySelectorAll('#thumbnails .item');

thumbnails &&
	thumbnails.forEach((item) => {
		item.addEventListener('click', () => {
			const thumbBg = window.getComputedStyle(item).backgroundImage;
			imgPrev.style.backgroundImage = thumbBg;

			thumbnails.forEach((item) => {
				item.classList.remove('active');
			});

			item.classList.add('active');
		});
	});
