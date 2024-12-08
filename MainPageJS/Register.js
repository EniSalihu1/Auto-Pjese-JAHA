document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const emri = document.getElementById("emri").value.trim();
    const mbiemri = document.getElementById("mbiemri").value.trim();
    const telefoni = document.getElementById("telefoni").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();

    let errorMessages = [];

    if (emri === "") {
        errorMessages.push("Ju lutem plotësoni emrin.");
    }

    if (mbiemri === "") {
        errorMessages.push("Ju lutem plotësoni mbiemrin.");
    }

    const phoneRegex = /^[0-9]{9,15}$/;
    if (!phoneRegex.test(telefoni)) {
        errorMessages.push("Ju lutem shkruani një numër telefoni të saktë.");
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorMessages.push("Ju lutem shkruani një email të saktë.");
    }

    if (password.length < 6) {
        errorMessages.push("Fjalëkalimi duhet të jetë të paktën 6 karaktere.");
    }

    if (password !== confirmPassword) {
        errorMessages.push("Fjalëkalimet nuk përputhen.");
    }

   
    if (errorMessages.length > 0) {
        alert(errorMessages.join("\n"));
    } else {
        alert("Regjistrimi u krye me sukses!");
        document.getElementById("registerForm").submit();
    }
});
