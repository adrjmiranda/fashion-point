const passInput = document.querySelector('#password');

const btnTogglePass = document.querySelector('#toggle-pass');

console.log(btnTogglePass);

btnTogglePass &&
	btnTogglePass.addEventListener('click', (e) => {
		const showPass = btnTogglePass.querySelector('.show-pass');
		const hidePass = btnTogglePass.querySelector('.hide-pass');

		showPass.classList.toggle('hide');
		hidePass.classList.toggle('hide');

		passInput &&
			passInput.setAttribute(
				'type',
				passInput.getAttribute('type') === 'password' ? 'text' : 'password'
			);
	});
