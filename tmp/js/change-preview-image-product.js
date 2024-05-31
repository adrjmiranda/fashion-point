const imgPrev = document.querySelector('.main-image');
const thumbnails = document.querySelectorAll('.thumbnails img');

thumbnails &&
	thumbnails.forEach((item) => {
		item.addEventListener('mouseover', () => {
			const thumbImg = item.getAttribute('src');
			imgPrev.setAttribute('src', thumbImg);

			thumbnails.forEach((item) => {
				item.classList.remove('active');
			});

			item.classList.add('active');
		});
	});
