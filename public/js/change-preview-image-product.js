const imagePrevious = document.querySelector('.main-image');
const thumbnailList = document.querySelectorAll('.thumbnails img');

thumbnailList &&
	thumbnailList.forEach((item) => {
		item.addEventListener('mouseover', () => {
			const thumbImg = item.getAttribute('src');
			imagePrevious.setAttribute('src', thumbImg);

			thumbnailList.forEach((item) => {
				item.classList.remove('active');
			});

			item.classList.add('active');
		});
	});
