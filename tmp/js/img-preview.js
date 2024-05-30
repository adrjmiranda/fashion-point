const previewContainer = document.querySelector('#main-img');
const imgInput = document.querySelector('#images');
const imgThumbnails = document.querySelector('#thumbnails');
const imtThumbItems = document.querySelectorAll('#thumbnails .item');

imgInput &&
	imgInput.addEventListener('change', (event) => {
		const files = event.target.files;

		const filesArray = [...files];

		if (filesArray.length > 4) {
			alert('Please select a maximum of 4 images');
			imgInput.value = null;
			return;
		}

		if (filesArray.length > 0) {
			filesArray.forEach((file, index) => {
				if (file) {
					if (!file.type.startsWith('image/')) {
						alert('Please select a valid image file');
						return;
					}

					const item = document.createElement('img');

					const reader = new FileReader();
					reader.onload = function (e) {
						imtThumbItems[
							index
						].style.backgroundImage = `url(${e.target.result})`;

						if (index == 0) {
							previewContainer.style.backgroundImage = `url(${e.target.result})`;
							imtThumbItems[index].classList.add('active');
						}
					};

					reader.readAsDataURL(file);

					imgThumbnails.appendChild(item);
				}
			});
		}

		// if (file) {
		// 	if (!file.type.startsWith('image/')) {
		// 		alert('Please select a valid image file');
		// 		return;
		// 	}

		// 	const reader = new FileReader();
		// 	reader.onload = function (e) {
		// 		previewContainer.style.backgroundImage = `url(${e.target.result})`;
		// 	};

		// 	reader.readAsDataURL(file);
		// }
	});
