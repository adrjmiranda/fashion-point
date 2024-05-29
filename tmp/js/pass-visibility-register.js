const passInput = document.querySelector('#password');
const passConfirmInput = document.querySelector('#password-confirmation');

const btnTogglePass = document.querySelector('#toggle-pass');
const btnTogglePassConfirmation = document.querySelector(
	'#toggle-pass-confirm'
);

btnTogglePass &&
	btnTogglePassConfirmation &&
	[btnTogglePass, btnTogglePassConfirmation].forEach((btn, index) => {
		btn.addEventListener('click', () => {
			const showPass = btn.querySelector('.show-pass');
			const hidePass = btn.querySelector('.hide-pass');

			showPass.classList.toggle('hide');
			hidePass.classList.toggle('hide');

			if (index === 1) {
				passInput &&
					passInput.setAttribute(
						'type',
						passInput.getAttribute('type') === 'password' ? 'text' : 'password'
					);
			} else {
				passConfirmInput &&
					passConfirmInput.setAttribute(
						'type',
						passConfirmInput.getAttribute('type') === 'password'
							? 'text'
							: 'password'
					);
			}
		});
	});
