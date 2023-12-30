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
        <div
            class="card-header d-flex align-items-center justify-content-between"
        >
            <h3 class="card-title">Add new Request</h3>
            <div class="btn btn-success ml-auto" @click="addproduct">
                + Add new product
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form ref="form" @submit.prevent="submitform" v-if="users.length > 0">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6" v-if="currentuseradmin">
                        <label for="clientname">Client Name</label>

                        <select
                            name="clientname"
                            v-model="sendrequest.clientname"
                            class="form-control"
                        >
                            <option hidden value="null">
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
                        <span v-if="errors && errors.clientname">
                            <p class="text text-danger">
                                {{ errors.clientname[0] }} *
                            </p>
                        </span>
                    </div>
                    <div class="form-group col-6">
                        <label for="suppliername">Select Supplier</label>

                        <select
                            name="suppliername"
                            v-model="sendrequest.suppliername"
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
                        <span v-if="errors && errors.suppliername">
                            <p class="text text-danger">
                                {{ errors.suppliername[0] }} *
                            </p>
                        </span>
                    </div>
                </div>
            </div>
            <hr />
            <div
                class="card-body"
                v-for="(index, ind) in numofproduct"
                :key="index"
            >
                <div class="text-center">
                    <p class="btn" style="margin: auto">{{ index }}</p>
                    <!-- <div
                        class="btn btn-danger ml-auto"
                        @click="minproduct(ind)"
                    >
                        -
                    </div> -->
                </div>
                <div class="form-group">
                    <label for="productid">Product Name</label>

                    <div
                        v-if="
                            errors && errors[`request.${index - 1}.productid`]
                        "
                    >
                        <p class="text text-danger">
                            {{ errors[`request.${index - 1}.productid`][0] }} *
                        </p>
                    </div>
                    <select
                        name="productid"
                        v-model="request[index - 1].productid"
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

                    <div
                        v-if="
                            errors &&
                            errors[`request.${index - 1}.productdescription`]
                        "
                    >
                        <p class="text text-danger">
                            {{
                                errors[
                                    `request.${index - 1}.productdescription`
                                ][0]
                            }}
                            *
                        </p>
                    </div>
                    <textarea
                        v-model="request[index - 1].productdescription"
                        name="productdescription"
                        type="text"
                        class="form-control"
                        id="productdescription"
                        placeholder="Enter product description"
                    ></textarea>
                </div>
                <div class="form-row">
                    <div class="col-8"></div>
                    <div class="form-group col-4">
                        <label for="clientname">Quantity</label>
                        <div
                            v-if="
                                errors &&
                                errors[`request.${index - 1}.quantity`]
                            "
                        >
                            <p class="text text-danger">
                                {{ errors[`request.${index - 1}.quantity`][0] }}
                                *
                            </p>
                        </div>

                        <input
                            type="number"
                            class="form-control"
                            v-model="request[index - 1].quantity"
                            placeholder="enter product quantity"
                        />
                    </div>
                </div>
                <!-- <div class="form-group">
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
                                @change="handleimage()"
                            />
                            <label
                                v-if="request[index - 1].image.name"
                                class="custom-file-label"
                                for="exampleInputFile"
                                >{{ request.image.name }}</label
                            >
                            <label
                                v-if="!request[index - 1].image.name"
                                class="custom-file-label"
                                for="exampleInputFile"
                                >Choose file
                            </label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div> -->
                <hr />
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
const request = ref([
    {
        productid: "",
        productdescription: "",
        quantity: "",
    },
]);

const sendrequest = ref({
    clientname: null,
    suppliername: "",
});
const form = ref(null);
const errors = ref(null);
const users = ref([]);
const suplier = ref([]);
const Allproduct = ref([]);
// const Allproductwithoutchanges = ref([]);

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
        // Allproductwithoutchanges.value = response.data;
    });
};
// const removeproductselected = () => {
//     for (let i = 0; i < request.value.length; i++) {
//         const item = request.value[i];
//         for (let i = 0; i < Allproduct.value.length; i++) {
//             if (item.productid == Allproduct.value[i].id) {
//                 Allproduct.value = Allproduct.value.filter((productItem) => {
//                     return item.productid !== productItem.id;
//                 });
//             }
//         }
//     }
// };

const numofproduct = ref(1);
const newObj = {
    productid: "",
    productdescription: "",
    clientname: "",
    suppliername: "",
    quantity: "",
};
const addproduct = () => {
    const newObjectCopy = { ...newObj };
    request.value.push(newObjectCopy);
    numofproduct.value++;
};
// const minproduct = (index) => {
//     console.log(index);
//     const newObjectCopy = { ...newObj };
//     newObjectCopy.splice(indexToRemove, 1);
//     numofproduct.value--;
// };
const submitform = () => {
    loading.value = true;
    const formData = new FormData();
    request.value.forEach((item, index) => {
        Object.entries(item).forEach(([key, value]) => {
            formData.append(`request[${index}][${key}]`, value);
        });
    });

    formData.append("requestsend", JSON.stringify(sendrequest.value));

    axios
        .post("/newrequestcreate", formData)
        .then(() => {
            toaster.success("Request Send Successfully");
            numofproduct.value = 1;
            request.value = [
                {
                    productid: "",
                    productdescription: "",
                    clientname: "",
                    suppliername: "",
                    quantity: "",
                },
            ]; // Clear the request array

            if (errors.value != null) {
                errors.value = null;
            }

            loading.value = false;
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
