(d => {

	let password = d.getElementById("password");
	let p = d.getElementById("validation");

	let checkPassword = () => {
		let passwordLength = password.value.length;
		let message = "";

		// Display error if password less than 6 characters
		if (passwordLength < 3) {
			message = "Password must be at least 6 characters";
			password.classList.add("red");
		} else if (passwordLength < 6) {
			message = "Almost there";
		} else {
			message = "";
			password.classList.remove("red");
		}
		p.textContent = message;
	}

	password.addEventListener("keyup", checkPassword);

})(document);