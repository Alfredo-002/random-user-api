<script>
async function getNewUser() {
    const res = await fetch("https://randomuser.me/api/");
    const data = await res.json();
    const user = data.results[0];

    // FOTO
    document.getElementById("userImage").src = user.picture.large;

    // DATOS
    const valuesList = document.getElementById("values_list").children;

    valuesList[0].dataset.value = `${user.name.first} ${user.name.last}`;
    valuesList[1].dataset.value = user.email;
    valuesList[2].dataset.value = new Date(user.dob?.date || "1984-01-01").toLocaleDateString();
    valuesList[3].dataset.value = `${user.location.street.number} ${user.location.street.name}`;
    valuesList[4].dataset.value = user.phone;
    valuesList[5].dataset.value = user.login.password;

    // MOSTRAR EL ÚLTIMO ELEMENTO COMO ACTIVO (password)
    for (let li of valuesList) li.classList.remove("active");
    valuesList[5].classList.add("active");
    document.getElementById("title").innerText = valuesList[5].dataset.title;
    document.getElementById("value").innerText = valuesList[5].dataset.value;
}

// CUANDO PASAS EL MOUSE SOBRE UN LI
document.addEventListener("mouseover", function (e) {
    if (e.target.tagName === "LI") {
        const li = e.target;
        const dataValue = li.dataset.value;

        for (let item of document.getElementById("values_list").children) {
            item.classList.remove("active");
        }
        li.classList.add("active");

        document.getElementById("title").innerText = li.dataset.title;
        document.getElementById("value").innerText = dataValue;
    }
});

// CARGAR USUARIO AL ENTRAR
getNewUser();
</script>
