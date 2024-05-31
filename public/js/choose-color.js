const colorInput = document.querySelector('#color-input');
const colorAddBtn = document.querySelector('#color-add');
const colorList = document.querySelector('#colors');

const hexToRgb = (hex) => {
	hex = hex.replace(/^#/, '');

	let bigint = parseInt(hex, 16);
	let r = (bigint >> 16) & 255;
	let g = (bigint >> 8) & 255;
	let b = bigint & 255;

	return { r: r, g: g, b: b };
};

const hexToRgbString = (hex) => {
	let rgb = hexToRgb(hex);
	return `rgb(${rgb.r}, ${rgb.g}, ${rgb.b})`;
};

colorAddBtn.addEventListener('click', () => {
	let currentColor = colorInput.value;
	currentColor = hexToRgbString(currentColor);

	let colorsAlreadyAdded = [];
	let items = colorList.querySelectorAll('li span');

	if (items) {
		Array.from(items).map((item) => {
			const color = item.style.backgroundColor;
			colorsAlreadyAdded.push(color);
		});
	}

	if (!colorsAlreadyAdded.includes(currentColor)) {
		const newItem = document.createElement('li');
		newItem.setAttribute('data-id', currentColor);

		newItem.innerHTML = `
  <span style="background-color: ${currentColor}"></span>
  <input type="checkbox" name="colors[]" value="${currentColor}" style="display: none;" checked />
  <button class="remove-color" type="button" data-id="${currentColor}">X</button>
  `;

		colorList.appendChild(newItem);
		colorsAlreadyAdded.push(currentColor);

		const removeButtons = colorList.querySelectorAll('li .remove-color');

		removeButtons.forEach((btn) => {
			btn.addEventListener('click', (event) => {
				const btnId = event.target.dataset.id;

				const colorBoxes = colorList.querySelectorAll('li');
				colorBoxes.forEach((colorItem) => {
					if (colorItem.dataset.id === btnId) {
						colorItem.remove();
					}
				});
			});
		});
	} else {
		alert('This color has already been added, choose another one');
		return;
	}
});
