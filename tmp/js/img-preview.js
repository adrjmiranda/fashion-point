const previewContainer = document.querySelector('#main-img-preview');
const imgInput = document.querySelector('#images');

imgInput &&
	imgInput.addEventListener('change', (event) => {
		const file = event.target.files[0];

		if (file) {
			if (!file.type.startsWith('image/')) {
				alert('Please select a valid image file');
				return;
			}

			const reader = new FileReader();
			reader.onload = function (e) {
				previewContainer.style.backgroundImage = `url(${e.target.result})`;
			};

			reader.readAsDataURL(file);
		}
	});
