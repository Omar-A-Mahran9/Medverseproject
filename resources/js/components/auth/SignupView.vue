<template>
    <section class="container-fluid back" style="width;: 100%px">
        <div class="container-fluid contain">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-12 pl-5 pr-5 form-container">
                    <div class="d-flex flex-column align-items-center gap-4">
                        <a class="navbar-brand" href="/">
                            <img
                                src="@/assets/image/Logo.svg"
                                width="200"
                                class="white-fill"
                            />
                        </a>
                        <h1 class="txt">Welcome To Med-Verse!</h1>
                        <h3
                            style="margin-bottom: 50px !important"
                            class="text-center"
                        >
                            Create Account
                        </h3>
                    </div>

                    <form @submit.prevent="submitForm" class="row g-5">
                        <div class="col-md-6">
                            <input
                                type="text"
                                placeholder="Full Name"
                                v-model="user.name"
                                name="name"
                                class="form-control"
                                id="inputEmail4"
                            />
                            <p class="text-danger" v-text="errors.name[0]"></p>
                        </div>

                        <div class="col-md-6">
                            <input
                                type="number"
                                name="phone"
                                v-model="user.phone"
                                placeholder="Contact Number"
                                class="form-control"
                                id="inputEmail4"
                            />
                            <p class="text-danger" v-text="errors.phone[0]"></p>
                        </div>

                        <div class="col-md-6">
                            <input
                                type="email"
                                placeholder="Email Address"
                                name="email"
                                v-model="user.email"
                                class="form-control"
                                id="inputEmail4"
                            />
                            <p class="text-danger" v-text="errors.email[0]"></p>
                        </div>

                        <div class="col-md-6">
                            <input
                                type="tex"
                                placeholder="City"
                                name="city"
                                v-model="user.city"
                                class="form-control"
                                id="inputEmail4"
                            />
                            <p class="text-danger" v-text="errors.city[0]"></p>
                        </div>

                        <div class="col-md-6">
                            <input
                                type="password"
                                placeholder="password"
                                name="password"
                                v-model="user.password"
                                class="form-control"
                                id="inputPassword4"
                            />
                            <p
                                class="text-danger"
                                v-text="errors.password[0]"
                            ></p>
                        </div>

                        <div v-if="user.type == 'DOCTOR'" class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                id="inputClinic"
                                placeholder="Clinic name"
                                name="clinicname"
                                v-model="user.clinicname"
                                required
                            />
                            <p
                                class="text-danger"
                                v-text="errors.clinicname[0]"
                            ></p>
                        </div>

                        <div v-if="user.type == 'STUDENT'" class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                id="universityname"
                                placeholder="University name"
                                name="universityname"
                                v-model="user.universityname"
                                required
                            />
                            <p
                                class="text-danger"
                                v-text="errors.clinicname[0]"
                            ></p>
                        </div>
                        <div v-if="user.type == 'Others'" class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                id="companyname"
                                placeholder="Company name"
                                name="companyname"
                                v-model="user.companyname"
                                required
                            />
                            <p
                                class="text-danger"
                                v-text="errors.clinicname[0]"
                            ></p>
                        </div>
                        <div class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                id="inputAddress"
                                placeholder="Address"
                                name="Address"
                                v-model="user.Address"
                            />
                            <p
                                class="text-danger"
                                v-text="errors.Address[0]"
                            ></p>
                        </div>

                        <div class="col-md-6">
                            <select
                                name="package"
                                v-model="user.type"
                                class="form-select"
                            >
                                <option hidden value="">
                                    Choose Your Type
                                </option>
                                <option
                                    v-for="role in roles"
                                    :key="role.value"
                                    :value="role.value"
                                >
                                    {{ role.name }}
                                </option>
                            </select>
                            <p class="text-danger" v-text="errors.type[0]"></p>
                        </div>

                        <div style="align-items: center" class="col-md-6 mt-5">
                            <button
                                type="submit"
                                class="btn btn-primary form-control"
                            >
                                sign Up
                            </button>
                        </div>
                        <div class="d-flex justify-content-center">
                            Already have an account?
                            <router-link
                                :to="{ name: 'login' }"
                                class="fw-bold"
                                style="text-decoration: none; color: black"
                                >Log in
                            </router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
select {
    background-color: #65c5b9;
    color: white;
    border-radius: 25px;
    width: 100%p;
    border: none;
    width: 100%;
    padding: 10px;
    margin-left: 15px;
    text-align: center;
}

.form-container {
    position: relative;
    width: 100%;
    max-width: 600px; /* Adjust the max-width as needed */
    margin: auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.8); /* Adjust the background opacity */
    border-radius: 15px; /* Adjust the radius */

    /* Add the following styles for the blurred background */
    overflow: hidden;
}

input {
    background: transparent;
}
.cover {
    width: 79%;
}
.txt {
    width: 100% !important;
    padding-bottom: 5px !important;
    text-align: center;
}
.form {
    width: 80%;
    margin: auto;
}
input {
    margin-left: 15px;
    padding: 0px;
    padding-bottom: 13px;
    border: none;
    border-radius: 0px;
    border-bottom: 2px solid rgb(174, 174, 174);
}
.btn-primary {
    background-color: #65c5b9;
    border-radius: 15px;
}
div .mapdiv {
    border-radius: 20px !important;
}
.back {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("@/assets/image/login.jpg") center center no-repeat;
    background-size: cover;
}
.contain {
    margin-top: 3%;
}
@media only screen and (max-width: 992px) {
    .respo {
        display: flex;
        flex-direction: column;
        justify-content: center !important;
        align-items: center !important;
        margin-bottom: 70px;
    }
    .txt {
        width: 100% !important;
        font-size: 30px;
        text-align: center;
    }
    .cover {
        width: 100%;
    }

    .container-fluid {
        width: 100%;
    }
}

/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    form input {
        text-align: center !important;
    }
    form {
        width: 100%;
        text-align: center !important;
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (max-width: 1200px) {
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
}

@media only screen and (min-width: 992px) {
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
}
</style>
<script setup>
import { usetoaster } from "../../toaster.js";
import axios from "axios";
import { onBeforeMount, onMounted, ref } from "vue";
const currentuser = window.Laravel.user;
const checklogin = () => {
    if (currentuser) {
        location.href = "/profile";
    }
};
const toaster = usetoaster();
const roles = ref([
    {
        name: "DOCTOR",
        value: "DOCTOR",
    },
    {
        name: "STUDENT",
        value: "STUDENT",
    },
    {
        name: "Others",
        value: "Others",
    },
]);
const user = ref({
    name: "",
    phone: "",
    email: "",
    city: "",
    clinicname: "",
    universityname: "",
    companyname: "",
    Address: "",
    role: "",
    Location: "",
    type: "",
    password: "",
});
const errors = ref({
    name: "",
    phone: "",
    email: "",
    city: "",
    clinicname: "",
    universityname: "",
    companyname: "",
    Address: "",
    Location: "",
    type: "",
    password: "",
});
const submitForm = () => {
    errors.value.name = "";
    errors.value.phone = "";
    errors.value.email = "";
    errors.value.city = "";
    errors.value.clinicname = "";
    errors.value.universityname = "";
    errors.value.companyname = "";
    errors.value.Address = "";
    errors.value.type = "";
    errors.value.password = "";
    axios
        .post("/register", user.value)
        .then((response) => {
            window.location.href = "/login";
            toaster.success("Welcom you are Rigistred Successfuly");
        })
        .catch((errorss) => {
            errors.value.name = errorss.response.data.errors.name
                ? errorss.response.data.errors.name
                : "";
            errors.value.phone = errorss.response.data.errors.phone
                ? errorss.response.data.errors.phone
                : "";
            errors.value.email = errorss.response.data.errors.email
                ? errorss.response.data.errors.email
                : "";
            errors.value.city = errorss.response.data.errors.city
                ? errorss.response.data.errors.city
                : "";
            errors.value.clinicname = errorss.response.data.errors.clinicname
                ? errorss.response.data.errors.clinicname
                : "";
            errors.value.universityname = errorss.response.data.errors
                .universityname
                ? errorss.response.data.errors.universityname
                : "";
            errors.value.companyname = errorss.response.data.errors.companyname
                ? errorss.response.data.errors.companyname
                : "";
            errors.value.Address = errorss.response.data.errors.Address
                ? errorss.response.data.errors.Address
                : "";
            errors.value.type = errorss.response.data.errors.type
                ? errorss.response.data.errors.type
                : "";
            errors.value.password = errorss.response.data.errors.password
                ? errorss.response.data.errors.password
                : "";
        });
};

onMounted(() => {
    checklogin();
});
</script>
