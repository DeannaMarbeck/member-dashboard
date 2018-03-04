(d => {

	let password = d.getElementById("password");
	let p = d.getElementById("validation");

	let checkPassword = () => {
		let passwordLength = password.value.length;
		let message = "";
		if (passwordLength < 3) {
			message = "Keep typing";
			// password.style.backgroundColor = "red";
			password.classList.add("red");
		} else if (passwordLength < 6) {
			message = "Almost there";

		} else {
			message = "Perfect";
		}
		p.textContent = message;
	}


	password.addEventListener("keyup", checkPassword);


})(document);