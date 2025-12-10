<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random User Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .icon {
            opacity: 0.4;
            transition: 0.2s;
            font-size: 24px;
        }
        .icon.active {
            opacity: 1;
            color: #4A90E2;
        }
        #title {
            font-size: 14px;
            color: #777;
        }
        #mainValue {
            font-size: 26px;
            font-weight: 600;
        }
        .values_list li:hover .icon {
            opacity: 1;
            color: #4A90E2;
        }
    </style>
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md text-center">

        <!-- FOTO + BOTÓN LOGOUT -->
        <div class="relative w-full flex justify-center mb-4">

            <button onclick="logout()"
                class="absolute right-0 -top-2 bg-red-600 text-white text-xs px-3 py-1 rounded-full shadow hover:bg-red-700 transition">
                Logout
            </button>

            <img id="avatar" class="w-32 h-32 object-cover rounded-full shadow-md border">
        </div>

        <!-- TEXTO PRINCIPAL -->
        <p id="title" class="text-gray-500"></p>
        <p id="mainValue" class="mb-6"></p>

        <!-- ICONOS -->
        <ul id="values_list" class="flex justify-around mt-6 text-xl">
            <li data-title="Hi, my name is" data-label="name" class="cursor-pointer p-2">
                <span class="icon">👤</span>
            </li>
            <li data-title="My email address is" data-label="email" class="cursor-pointer p-2">
                <span class="icon">📧</span>
            </li>
            <li data-title="My birthday is" data-label="birthday" class="cursor-pointer p-2">
                <span class="icon">🎂</span>
            </li>
            <li data-title="My address is" data-label="address" class="cursor-pointer p-2">
                <span class="icon">📍</span>
            </li>
            <li data-title="My phone number is" data-label="phone" class="cursor-pointer p-2">
                <span class="icon">📱</span>
            </li>
            <li data-title="My password is" data-label="password" class="cursor-pointer p-2">
                <span class="icon active">🔑</span>
            </li>
        </ul>

        <!-- BOTÓN ABAJO -->
        <div class="mt-6">
            <button onclick="loadUser()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                Generate User
            </button>
        </div>

    </div>

    <script>
        let currentUser = {};

        // SOLO cargar usuario si NO estás en /login
        if (window.location.pathname !== "/login") {
            loadUser();
        }

        async function loadUser() {
            const res = await fetch('/random-user');
            const apiData = await res.json();
            const d = apiData.results[0];

            currentUser = {
                name: `${d.name.first} ${d.name.last}`,
                email: d.email,
                birthday: d.dob?.date ? new Date(d.dob.date).toLocaleDateString() : "N/A",
                address: `${d.location.street.name} ${d.location.street.number}, ${d.location.city}`,
                phone: d.phone,
                password: d.login.password,
                picture: d.picture.large
            };

            document.getElementById('avatar').src = currentUser.picture;
            showData('password');
        }

        function showData(label) {
            const item = document.querySelector(`li[data-label="${label}"]`);
            const title = item.dataset.title;
            const value = currentUser[label];

            document.getElementById('title').textContent = title;
            document.getElementById('mainValue').textContent = value;

            document.querySelectorAll(".icon").forEach(i => i.classList.remove("active"));
            item.querySelector(".icon").classList.add("active");
        }

        document.querySelectorAll("#values_list li").forEach(li => {
            li.addEventListener("mouseenter", () => showData(li.dataset.label));
        });

        // LOGOUT REAL
        function logout() {
            fetch("/logout", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(() => window.location.href = "/");
        }
    </script>

</body>
</html>
