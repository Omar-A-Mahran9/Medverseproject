<template>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand"
                ><img src="@/assets/image/Logo.svg" class="log"
            /></a>

            <form
                class="searc d-flex align-items-center"
                style="
                    background-color: #f3f3f3;
                    border-radius: 15px;
                    width: 40%;
                "
            >
                <button class="searc btn" type="submit">
                    <img src="@/assets/image/search.svg" />
                </button>
                <input
                    class="searc"
                    type="search"
                    placeholder="Type for Search"
                    aria-label="Search"
                    style="
                        background-color: transparent;
                        border: none;
                        width: 100%;
                    "
                />
            </form>

            <div class="d-flex gap-4 align-items-center">
                <div v-if="user.user.type == 'DOCTOR'">
                    Welcome <strong>DR.</strong>{{ user.user.name }} !
                </div>
                <div v-else>Welcome {{ user.user.name }} !</div>

                <button @click="logout" class="btn btn-primary">Logout</button>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent"
                    aria-controls="navbarToggleExternalContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="prof">
                    <img src="@/assets/image/profileicon.svg" />
                </a>
            </div>
        </div>
    </nav>
    <div
        class="collapse"
        id="navbarToggleExternalContent"
        style="width: 20%; position: absolute; right: 20px; z-index: 999999999"
    >
        <ul
            class="bg-white row text-center"
            style="
                padding: 5px;
                padding-top: 25px;
                border-radius: 29px;
                width: 100%;
                box-shadow: 0px 5.5px 5px 0px rgba(0, 0, 0, 0.24),
                    0px 9px 18px 0px rgba(0, 0, 0, 0.18);
            "
        >
            <li class="list-group-item col-6" style="border: none !important">
                <a href="/consultant" style="text-decoration: none">
                    <img
                        src="@/assets/image/Drawer/messages-icon.svg"
                        width="20%"
                    />
                    <p>Consultant</p>
                </a>
            </li>
            <li class="list-group-item col-6" style="border: none !important">
                <a href="/inventory" style="text-decoration: none">
                    <img
                        src="@/assets/image/Drawer/dashboard.svg"
                        width="20%"
                    />
                    <p>Inventory</p>
                </a>
            </li>
            <li class="list-group-item col-6" style="border: none !important">
                <a href="/academic" style="text-decoration: none"
                    ><img src="@/assets/image/Drawer/Vector.svg" width="20%" />
                    <p>Courses</p>
                </a>
            </li>
            <li class="list-group-item col-6" style="border: none !important">
                <a>
                    <img src="@/assets/image/Drawer/hover.svg" width="20%" />
                    <p>contact us</p>
                </a>
            </li>
        </ul>
    </div>
</template>
<style scoped>
.navbar-toggler {
    display: block !important;
    border: none !important;
}
span {
    background-image: url("../../../assets/image/menuicon.svg");

    color: red !important;
}
.res {
    margin-left: 20px;
    margin-bottom: 6px;
    border: none !important;
    font-size: 20px !important;
}

@media only screen and (max-width: 991px) {
    .log {
        width: 70%;
    }
    .botto {
        width: 150px;

        margin: 10px;
    }
    .res {
        margin-left: 20px;
        margin-bottom: 6px;
        border: none !important;
        font-size: 20px !important;
    }
    .prof,
    .searc {
        display: none !important;
        visibility: hidden;
    }
    li {
        cursor: pointer;
    }
}
</style>
<script setup>
const user = window.Laravel;
const logout = () => {
    axios.post("/logout").then(() => {
        // Redirect the user to the login page
        window.location.href = "/login";
    });
};
</script>
