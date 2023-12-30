<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <p class="text-danger">{{ errorrr }}</p>
                            <input
                                ref="openfileinput"
                                type="file"
                                class="d-none"
                                @change="handleimage"
                            />
                            <img
                                @click="openfile"
                                class="profile-user-img img-circle"
                                :src="
                                    imageprofieurl
                                        ? imageprofieurl
                                        : imageUrl + '/' + form.image
                                "
                                alt="User profile picture"
                            />
                        </div>

                        <h3 class="profile-username text-center">
                            {{ form.name }}
                        </h3>

                        <p class="text-muted text-center">
                            {{ form.role }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    href="#profile"
                                    data-toggle="tab"
                                    ><i class="fa fa-user mr-1"></i> Edit
                                    Profile</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="#changePassword"
                                    data-toggle="tab"
                                    ><i class="fa fa-key mr-1"></i> Change
                                    Password</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <form
                                    @submit.prevent="editprofile"
                                    class="form-horizontal"
                                >
                                    <div class="form-row">
                                        <div class="col-4 form-group">
                                            <label
                                                for="inputName"
                                                class="col-form-label"
                                                >Name</label
                                            >
                                            <div class=" ">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="form.name"
                                                    id="inputName"
                                                    placeholder="Name"
                                                />

                                                <span
                                                    class="text-danger text-sm"
                                                    v-if="errorr && errorr.name"
                                                    >{{ errorr.name[0] }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label
                                                for="inputEmail"
                                                class="col-form-label"
                                                >Email</label
                                            >
                                            <div class=" ">
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    v-model="form.email"
                                                    id="inputEmail"
                                                    placeholder="Email"
                                                />
                                                <span
                                                    class="text-danger text-sm"
                                                    v-if="
                                                        errorr && errorr.email
                                                    "
                                                    >{{ errorr.email[0] }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label
                                                for="inputcity"
                                                class="col-form-label"
                                                >City</label
                                            >
                                            <div class=" ">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="form.city"
                                                    id="inputCity"
                                                    placeholder="City"
                                                />
                                                <span
                                                    class="text-danger text-sm"
                                                    v-if="errorr && errorr.city"
                                                    >{{ errorr.city[0] }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label
                                                for="inputUsername"
                                                class="col-form-label"
                                                >Username</label
                                            >
                                            <div class=" ">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="form.username"
                                                    id="inputUsername"
                                                    placeholder="Username"
                                                />
                                                <span
                                                    class="text-danger text-sm"
                                                    v-if="
                                                        errorr &&
                                                        errorr.username
                                                    "
                                                    >{{
                                                        errorr.username[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label
                                                for="inputphone"
                                                class="col-form-label"
                                                >Phone number</label
                                            >
                                            <div class=" ">
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    v-model="form.phone"
                                                    id="inputUserphone"
                                                    placeholder="phone"
                                                />
                                                <span
                                                    class="text-danger text-sm"
                                                    v-if="
                                                        errorr && errorr.phone
                                                    "
                                                    >{{ errorr.phone[0] }}</span
                                                >
                                            </div>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label
                                                for="inputphone"
                                                class="col-form-label"
                                                >Job title</label
                                            >
                                            <div class=" ">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="form.position"
                                                    id="inputUserposition"
                                                    placeholder="Doctor,Owner,nurse... "
                                                />
                                                <span
                                                    class="text-danger text-sm"
                                                    v-if="
                                                        errorr &&
                                                        errorr.position
                                                    "
                                                    >{{
                                                        errorr.position[0]
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >
                                                <i class="fa fa-save mr-1"></i>
                                                Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="changePassword">
                                <form
                                    @submit.prevent="updatepass"
                                    class="form-horizontal"
                                >
                                    <div class="form-group row">
                                        <label
                                            for="currentPassword"
                                            class="col-sm-3 col-form-label"
                                            >Current Password</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="currentPassword"
                                                v-model="foorm.currentpass"
                                                placeholder="Current Password"
                                            />
                                            <span
                                                class="text-danger text-sm"
                                                v-if="
                                                    errorr &&
                                                    errorr.current_password
                                                "
                                                >{{
                                                    errorr.current_password[0]
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            for="newPassword"
                                            class="col-sm-3 col-form-label"
                                            >New Password</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="password"
                                                class="form-control"
                                                v-model="foorm.newpass"
                                                id="newPassword"
                                                placeholder="New Password"
                                            />
                                            <span
                                                class="text-danger text-sm"
                                                v-if="errorr && errorr.password"
                                                >{{ errorr.password[0] }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            for="passwordConfirmation"
                                            class="col-sm-3 col-form-label"
                                            >Confirm New Password</label
                                        >
                                        <div class="col-sm-9">
                                            <input
                                                type="password"
                                                class="form-control"
                                                v-model="foorm.confirmpass"
                                                id="passwordConfirmation"
                                                placeholder="Confirm New Password"
                                            />
                                            <span
                                                class="text-danger text-sm"
                                                v-if="
                                                    errorr &&
                                                    errorr.password_confirmation
                                                "
                                                >{{
                                                    errorr
                                                        .password_confirmation[0]
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button
                                                type="submit"
                                                class="btn btn-success"
                                            >
                                                <i class="fa fa-save mr-1"></i>
                                                Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style>
.profile-user-img:hover {
    cursor: pointer;
    filter: blur(7px);
    content: "welcom";
}
</style>
<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { usetoaster } from "../../../../toaster.js";
const imageUrl = new URL("../../../../../../storage/app", import.meta.url);

const toaster = usetoaster();
const errorr = ref([]);
const foorm = ref({
    currentpass: "",
    newpass: "",
    confirmpass: "",
});
const openfileinput = ref(null);
const imageprofieurl = ref(imageUrl + "/photos/noimage.png");
const openfile = () => {
    openfileinput.value.click();
};
const errorrr = ref("");
const handleimage = (event) => {
    const file = event.target.files[0];
    imageprofieurl.value = URL.createObjectURL(file);
    const formData = new FormData();
    formData.append("Profile_image", file);
    axios
        .post("/api/uploadimage", formData)
        .then(() => {
            toaster.success("Image Updated Successfuly");
            errorrr.value = "";
        })
        .catch((error) => {
            errorrr.value = error.response.data.errors.Profile_image[0];
        });
};
const form = ref({
    name: "",
    role: "",
    email: "",
    city: "",
    username: "",
    phone: "",
    image: "",
    position: "",
});
const updatepass = () => {
    axios
        .post("/api/updatepass", foorm.value)
        .then((res) => {
            toaster.success("password Updated Successfuly");
            foorm.value.currentpass = "";
            foorm.value.newpass = "";
            foorm.value.confirmpass = "";
        })
        .catch((error) => {
            errorr.value = error.response.data.errors;
        });
};

const editprofile = () => {
    errorr.value = null;
    axios
        .post("/api/profile", form.value)
        .then((res) => {
            toaster.success("User Updated Successfuly");
        })
        .catch((error) => {
            errorr.value = error.response.data.errors;
        });
};
const getuser = () => {
    axios.get("/api/profile").then((res) => {
        form.value = res.data;
        if (res.data.image != null) {
            imageprofieurl.value = null;
        }
    });
};
onMounted(() => {
    getuser();
});
</script>
