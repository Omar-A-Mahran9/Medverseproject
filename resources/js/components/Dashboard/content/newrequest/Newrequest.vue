<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">New Request</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New Request</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-danger m-5">
        <div class="card-header">
            <h3 class="card-title">Add new Request</h3>
        </div>

        <!-- /.card-header -->
        <!-- form start -->

        <form ref="form" @submit.prevent="submitform" v-if="users.length > 0">
            <div class="card-body">
                <div class="form-group">
                    <label for="productid">Product Name</label>
                    <p
                        v-if="errors && errors.productid"
                        class="text text-danger"
                    >
                        {{ errors.productid }}*
                    </p>
                    <select
                        name="productid"
                        v-model="request.productid"
                        class="form-control"
                    >
                        <option hidden value="">choose product</option>
                        <option
                            v-for="product in Allproduct"
                            :key="product.id"
                            :value="product.id"
                        >
                            {{ product.productname }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="productdescription">Product Description</label>
                    <p
                        v-if="errors && errors.productdescription"
                        class="text text-danger"
                    >
                        {{ errors.productdescription[0] }}*
                    </p>
                    <textarea
                        v-model="request.productdescription"
                        name="productdescription"
                        type="text"
                        class="form-control"
                        id="productdescription"
                        placeholder="Enter product description"
                    ></textarea>
                </div>
                <div class="form-row">
                    <div class="col-8">
                        <div class="form-row">
                            <div
                                class="form-group col-6"
                                v-if="currentuseradmin"
                            >
                                <label for="clientname">Client Name</label>
                                <p
                                    v-if="errors && errors.clientname"
                                    class="text text-danger"
                                >
                                    {{ errors.clientname[0] }}*
                                </p>

                                <select
                                    name="clientname"
                                    v-model="request.clientname"
                                    class="form-control"
                                >
                                    <option hidden value="">
                                        choose client name
                                    </option>

                                    <option
                                        v-for="user in users"
                                        :key="user.id"
                                        :value="user.id"
                                    >
                                        {{ user.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="suppliername"
                                    >Select Supplier</label
                                >
                                <p
                                    v-if="errors && errors.suppliername"
                                    class="text text-danger"
                                >
                                    {{ errors.suppliername[0] }}*
                                </p>

                                <select
                                    name="suppliername"
                                    v-model="request.suppliername"
                                    class="form-control"
                                >
                                    <option hidden value="">
                                        choose supplier name
                                    </option>
                                    <option
                                        v-for="user in suplier"
                                        :key="user.id"
                                        :value="user.id"
                                    >
                                        {{ user.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-4">
                        <label for="clientname">Quantity</label>
                        <p
                            v-if="errors && errors.quantity"
                            class="text text-danger"
                        >
                            {{ errors.quantity[0] }}*
                        </p>
                        <input
                            type="number"
                            class="form-control"
                            v-model="request.quantity"
                            placeholder="enter product quantity"
                        />
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Image</label>

                    <p v-if="errors && errors.image" class="text text-danger">
                        {{ errors.image[0] }}*
                    </p>
                    <div class="input-group">
                        <div class="custom-file">
                            <input
                                type="file"
                                class="custom-file-input"
                                id="exampleInputFile"
                                name="image"
                                @change="handleimage"
                            />
                            <label
                                v-if="request.image.name"
                                class="custom-file-label"
                                for="exampleInputFile"
                                >{{ request.image.name }}</label
                            >
                            <label
                                v-if="!request.image.name"
                                class="custom-file-label"
                                for="exampleInputFile"
                                >Choose file
                            </label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button
                    v-if="!loading"
                    type="submit"
                    class="btn btn-danger pr-5 pl-5"
                >
                    Submit
                </button>
                <button
                    v-if="loading"
                    class="btn btn-danger"
                    type="button"
                    disabled
                >
                    <span
                        class="spinner-grow spinner-grow-sm"
                        role="status"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Loading...</span>
                </button>
            </div>
        </form>
        <h3 v-else class="text-danger text-center">
            Sorry you don't have any users until yet
        </h3>
    </div>
</template>
<script setup>
import { usetoaster } from "../../../../toaster.js";
const toaster = usetoaster();
import { ref } from "vue";
import axios from "axios";
import { onMounted } from "vue";
const currentuseradmin = window.Laravel.user
    ? window.Laravel.user.role == "ADMIN"
    : "";
const currentuser = window.Laravel.user;

const loading = ref(false);
const request = ref({
    productid: "",
    productdescription: "",
    clientname: "",
    suppliername: "",
    image: "",
    quantity: "",
});

const form = ref(null);
const errors = ref(null);
const users = ref([]);
const suplier = ref([]);
const Allproduct = ref([]);

const getusers = () => {
    axios.get("/api/users").then((response) => {
        response.data.data.forEach((element) => {
            if (element.role == "USER") {
                users.value.push(element);
            }
            if (element.role == "SUPPLIER") {
                suplier.value.push(element);
            }
        });
        // users.value = response.data;
    });
};

const getproduct = () => {
    axios.get("/product").then((response) => {
        Allproduct.value = response.data;
    });
};
const handleimage = (event) => {
    const file = event.target.files[0];
    request.value.image = file;
};
const submitform = () => {
    loading.value = true;
    const formData = new FormData();
    formData.append("productid", request.value.productid);
    formData.append("productdescription", request.value.productdescription);
    formData.append("currentuser", currentuser.id);
    formData.append("clientname", request.value.clientname);
    formData.append("suppliername", request.value.suppliername);
    formData.append("quantity", request.value.quantity);
    formData.append("image", request.value.image);

    axios
        .post("/newrequestcreate", formData)
        .then(() => {
            toaster.success("Request Send Successfully");
            form.value.reset();
            if (errors.value != null) {
                errors.value = null;
            }
            loading.value = false;
            request.value.productid = "";
            request.value.productdescription = "";
            request.value.clientname = "";
            request.value.suppliername = "";
            request.value.image = "";
            request.value.quantity = "";
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
            loading.value = false;
        });
};
onMounted(() => {
    getusers();
    getproduct();
});
</script>
