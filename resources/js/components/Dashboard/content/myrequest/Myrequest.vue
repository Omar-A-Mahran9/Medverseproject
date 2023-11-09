<template>
    <div
        v-if="reload"
        class="spinner-grow text-danger"
        style="margin: 50%"
        role="status"
    ></div>
    <div v-if="!reload">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">My Request</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="wrapper">
                    <!-- Content Wrapper. Contains page content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div
                                        class="pl-5 pr-5 pt-4 d-flex align-items-center justify-content-between"
                                    >
                                        <div>
                                            <h3 class="card-title">
                                                All users
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Request ID</th>
                                                    <th>Status</th>
                                                    <th v-if="currentuseradmin">
                                                        Supplier name
                                                    </th>
                                                    <th v-if="currentuseradmin">
                                                        Supplier num
                                                    </th>
                                                    <th>Date</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        request, index
                                                    ) in allrequest"
                                                    :key="request.id"
                                                >
                                                    <td
                                                        v-if="
                                                            request.getuser
                                                                .role === 'USER'
                                                        "
                                                        class="text-danger"
                                                        style="
                                                            font-weight: 1000;
                                                        "
                                                    >
                                                        {{ index + 1 }}
                                                    </td>
                                                    <td v-else>
                                                        {{ index + 1 }}
                                                    </td>

                                                    <td>
                                                        {{ request.id }}
                                                        <span
                                                            v-if="
                                                                request.getuser
                                                                    .role ==
                                                                    'USER' ||
                                                                request.getuser
                                                                    .role ==
                                                                    'ADMIN'
                                                            "
                                                            @click="
                                                                showdetailsmodal(
                                                                    request
                                                                )
                                                            "
                                                            class="btn btn-info float-right"
                                                            style="
                                                                border-radius: 20px;
                                                                padding-right: 10px;
                                                                padding-left: 10px;
                                                                padding-top: 0px;
                                                                padding-bottom: 0px;
                                                            "
                                                            >Detils</span
                                                        >
                                                    </td>
                                                    <td>
                                                        <select
                                                            v-if="
                                                                (request.statue ==
                                                                    'PENDING' &&
                                                                    currentuseradmin) ||
                                                                request.getuser
                                                                    .role ===
                                                                    'SUPPLIER'
                                                            "
                                                            class="form-control w-50"
                                                            @change="
                                                                changestatue(
                                                                    request,
                                                                    $event
                                                                        .target
                                                                        .value
                                                                )
                                                            "
                                                        >
                                                            <option
                                                                v-for="statue in statues"
                                                                :value="
                                                                    statue.value
                                                                "
                                                                :selected="
                                                                    request.statue ===
                                                                    statue.value
                                                                "
                                                            >
                                                                {{
                                                                    statue.name
                                                                }}
                                                            </option>
                                                        </select>
                                                        <!-- <select
                                                            v-else-if="
                                                                request.statue ==
                                                                    'PENDING' &&
                                                                supplieruser &&
                                                                (request.getuser
                                                                    .role ===
                                                                    'ADMIN' ||
                                                                    request
                                                                        .getuser
                                                                        .role ===
                                                                        'USER')
                                                            "
                                                            class="form-control w-50"
                                                            @change="
                                                                changestatue(
                                                                    request,
                                                                    $event
                                                                        .target
                                                                        .value
                                                                )
                                                            "
                                                        >
                                                            <option
                                                                v-for="statue in statues"
                                                                :value="
                                                                    statue.value
                                                                "
                                                                :selected="
                                                                    request.statue ===
                                                                    statue.value
                                                                "
                                                            >
                                                                {{
                                                                    statue.name
                                                                }}
                                                            </option>
                                                        </select> -->
                                                        <p
                                                            v-else
                                                            class="text-primary"
                                                        >
                                                            {{ request.statue }}
                                                        </p>
                                                    </td>

                                                    <td v-if="currentuseradmin">
                                                        {{
                                                            request.getsupplier
                                                                ?.name ??
                                                            "Unknown Supplier"
                                                        }}
                                                    </td>

                                                    <td v-if="currentuseradmin">
                                                        {{
                                                            request.getsupplier
                                                                ?.phone ??
                                                            "Unknown supplier phone"
                                                        }}
                                                    </td>

                                                    <td>
                                                        {{
                                                            moment(
                                                                request.created_at
                                                            ).format(format)
                                                        }}
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a
                                                                v-if="
                                                                    (request
                                                                        .getuser
                                                                        .role ===
                                                                        'ADMIN' &&
                                                                        currentuser.role ==
                                                                            'ADMIN' &&
                                                                        request.statue ==
                                                                            'PENDING') ||
                                                                    (currentuser.role ==
                                                                        'USER' &&
                                                                        request.statue ==
                                                                            'PENDING')
                                                                "
                                                                class="mr-4"
                                                                href="#"
                                                                @click="
                                                                    editrequest(
                                                                        request
                                                                    )
                                                                "
                                                                ><i
                                                                    class="fas fa-pen text-white bg-primary rounded p-1"
                                                                ></i
                                                            ></a>
                                                            <a
                                                                v-if="
                                                                    currentuser.role ==
                                                                        'ADMIN' ||
                                                                    (currentuser.role ==
                                                                        'USER' &&
                                                                        request.statue ==
                                                                            'PENDING')
                                                                "
                                                                href="#"
                                                                @click="
                                                                    deleterequest(
                                                                        request
                                                                    )
                                                                "
                                                                ><i
                                                                    class="fas fa-trash text-danger"
                                                                ></i
                                                            ></a>
                                                            <p
                                                                v-else-if="
                                                                    currentuser.role ==
                                                                        'SUPPLIER' &&
                                                                    request.statue ==
                                                                        'PENDING'
                                                                "
                                                                class="text-success"
                                                            >
                                                                No Action until
                                                                yet
                                                            </p>
                                                            <p
                                                                v-else
                                                                class="text-success"
                                                            >
                                                                Done
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->

                    <!-- /.content-wrapper -->
                </div>
            </div>
        </div>
        <div
            id="deleteModal"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="exampleModalLabel"
                            style="font-weight: bold"
                        >
                            Delete Request
                        </h5>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true" class="text-danger"
                                >&times;</span
                            >
                        </button>
                    </div>

                    <div class="modal-body">
                        <h5 class="text-cneter fw-bold">
                            Are you sure you want to delete this Request?
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click.prevent="confirmdelete"
                            type="submit"
                            class="btn btn-danger"
                        >
                            Delete Request
                        </button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            id="detailsmodal"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="exampleModalLabel"
                            style="font-weight: bold"
                        >
                            Request Details
                        </h5>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true" class="text-danger"
                                >&times;</span
                            >
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div
                            class="col-6"
                            style="border-right: 2px solid rgb(203, 203, 203)"
                        >
                            <div>
                                <p style="font-weight: bold">
                                    Request by :
                                    <span
                                        style="font-weight: normal"
                                        v-if="request.clientname"
                                        >{{ request.clientname.name }}</span
                                    >
                                </p>
                            </div>
                            <div>
                                <p style="font-weight: bold">
                                    Request owner phone:
                                    <span
                                        style="font-weight: normal"
                                        v-if="request.clientname"
                                        >{{ request.clientname.phone }}</span
                                    >
                                </p>
                            </div>
                            <div>
                                <p style="font-weight: bold">
                                    Request owner email:
                                    <span
                                        style="font-weight: normal"
                                        v-if="request.clientname"
                                        >{{ request.clientname.email }}</span
                                    >
                                </p>
                            </div>
                            <div>
                                <p style="font-weight: bold">
                                    product description:
                                    <span style="font-weight: normal">{{
                                        request.productdescription
                                    }}</span>
                                </p>
                            </div>
                            <div v-if="request.suppliername">
                                <hr />

                                <h5 class="text-info">Supplier Details:</h5>

                                <div>
                                    <p style="font-weight: bold">
                                        supplier name:
                                        <span style="font-weight: normal">{{
                                            request.suppliername.name
                                        }}</span>
                                    </p>
                                </div>
                                <div>
                                    <p style="font-weight: bold">
                                        client phone:
                                        <span style="font-weight: normal">{{
                                            request.suppliername.phone
                                        }}</span>
                                    </p>
                                </div>
                                <div>
                                    <p style="font-weight: bold">
                                        client phone:
                                        <span style="font-weight: normal">{{
                                            request.suppliername.email
                                        }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div v-for="product in Allproduct">
                                <div v-if="product.id == request.productid">
                                    <div>
                                        <p style="font-weight: bold">
                                            product name:
                                            <span
                                                style="font-weight: normal"
                                                v-if="request.productid"
                                            >
                                                {{ product.productname }}
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p style="font-weight: bold">
                                            product code:

                                            <span
                                                style="font-weight: normal"
                                                v-if="request.productid"
                                            >
                                                {{ product.productcode }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <p style="font-weight: bold">
                                    Quantity:
                                    <span style="font-weight: normal">
                                        {{ request.quantity }}
                                    </span>
                                </p>
                            </div>

                            <div v-if="request.clientname">
                                <hr />
                                <h5 class="text-info">Send To:</h5>
                                <div v-for="user in users">
                                    <div v-if="user.id == request.client_id">
                                        <div>
                                            <p style="font-weight: bold">
                                                clientname:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.name }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client phone:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.phone }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client Email:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.email }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                Client Address:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.Address }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client City:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.city }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client location:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.Location }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        v-if="user.id == request.clientname.id"
                                    >
                                        <div>
                                            <p style="font-weight: bold">
                                                clientname:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.name }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client phone:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.phone }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client Email:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.email }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                Client Address:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.Address }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client City:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.city }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p style="font-weight: bold">
                                                client location:
                                                <span
                                                    style="font-weight: normal"
                                                >
                                                    <span>
                                                        {{ user.Location }}
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button
                     
                            type="submit"
                            class="btn btn-danger"
                        >
                            Accept Request
                        </button> -->
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            id="editformmodal"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="exampleModalLabel"
                            style="font-weight: bold"
                        >
                            Edit Request
                        </h5>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true" class="text-danger"
                                >&times;</span
                            >
                        </button>
                    </div>
                    <form ref="form" @submit.prevent="submitform">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="productname"
                                        >Product Name</label
                                    >
                                    <p
                                        v-if="errors && errors.productname"
                                        class="text text-danger"
                                    >
                                        {{ errors.productname }}*
                                    </p>

                                    <select
                                        name="productname"
                                        v-model="request.productid"
                                        class="form-control"
                                    >
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
                                    <label for="productdescription"
                                        >Product Description</label
                                    >
                                    <p
                                        v-if="
                                            errors && errors.productdescription
                                        "
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
                                                <label for="clientname"
                                                    >Client Name</label
                                                >
                                                <p
                                                    v-if="
                                                        errors &&
                                                        errors.clientname
                                                    "
                                                    class="text text-danger"
                                                >
                                                    {{ errors.clientname[0] }}*
                                                </p>
                                                <select
                                                    name="clientname"
                                                    v-model="request.clientname"
                                                    class="form-control"
                                                >
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
                                                    v-if="
                                                        errors &&
                                                        errors.suppliername
                                                    "
                                                    class="text text-danger"
                                                >
                                                    {{
                                                        errors.suppliername[0]
                                                    }}*
                                                </p>
                                                <select
                                                    name="suppliername"
                                                    v-model="
                                                        request.suppliername
                                                    "
                                                    class="form-control"
                                                >
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
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>

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
                                            <span class="input-group-text"
                                                >Upload</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="modal-footer">
                            <button
                                v-if="!loading"
                                type="submit"
                                class="btn btn-danger"
                            >
                                Update Request
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
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import moment from "moment";
import { usetoaster } from "../../../../toaster.js";
const format = window.Laravel.format;
const supplieruser = window.Laravel.user.role == "SUPPLIER";
const currentuser = window.Laravel.user;
const currentuseradmin = window.Laravel.user
    ? window.Laravel.user.role == "ADMIN"
    : "";
const Allproduct = ref([]);

const request = ref({
    productid: "",
    productdescription: "",
    clientname: "",
    suppliername: "",
    image: "",
    quantity: "",
    currentuser: currentuser.id,
    productname: "",
    client_id: "",
});

const statues = ref([
    {
        name: "PENDING",
        value: "PENDING",
    },
    {
        name: "ACCEPTED",
        value: "ACCEPTED",
    },
]);

const form = ref(null);
const formValues = ref();

const toaster = usetoaster();

const errors = ref(null);

const reload = ref(false);
const allrequest = ref([]);
const suplier = ref([]);
const requestidbeingDelete = ref(null);
const users = ref([]);
const loading = ref(false);
const requestidvalue = ref();
const getallrequest = () => {
    reload.value = true;
    axios.get(`/requests/${currentuser.id}`).then((response) => {
        allrequest.value = response.data.filter((request) => {
            if (
                currentuser.role == "SUPPLIER" &&
                request.statue == "ACCEPTED"
            ) {
                return 1;
            } else if (currentuser.role == "ADMIN") {
                return 1;
            } else if (currentuser.role == "USER") {
                return 1;
            } else {
                return 0;
            }
        });
        reload.value = false;
    });
};
const changestatue = (request, statue) => {
    if (statue == "PENDING") {
        alert("Sorry this request is Accepted");
    } else {
        axios
            .patch(`/api/request/${request.id}/change-statue`, {
                statue: statue,
            })
            .then((response) => {
                if (response.data.erroor) {
                    toaster.error(response.data.erroor);
                } else {
                    console.log();
                    toaster.success("statue Changed Successfuly");
                }
            });
    }
};
const getproduct = () => {
    axios.get("/product").then((response) => {
        Allproduct.value = response.data;
    });
};
const getusers = () => {
    axios.get("/api/usersobject").then((response) => {
        response.data.forEach((element) => {
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
const deleterequest = (request) => {
    requestidbeingDelete.value = request.id;
    $("#deleteModal").modal("show");
};
const editrequest = (data) => {
    requestidvalue.value = data.id;
    request.value.productid = data.getproduct.id;
    request.value.productdescription = data.productdescription;
    if (data.image != null) {
        // request.value.image = data.image;
    }
    request.value.quantity = data.quantity;
    request.value.clientname = data.client_id;
    request.value.suppliername = data.getsupplier.id;
    $("#editformmodal").modal("show");
};
const confirmdelete = () => {
    axios
        .delete(`/requests/delete/${requestidbeingDelete.value}`)
        .then((response) => {
            allrequest.value = allrequest.value.filter(
                (request) => request.id !== requestidbeingDelete.value
            );
            // const index = users.value.findIndex(
            //     (user) => user.id === response.data.id
            // );
            // users.value[index] = response.data;
            $("#deleteModal").modal("hide");
            toaster.success("User deleted successfully!");
        });
};
const showdetailsmodal = (requestt) => {
    request.value.productid = requestt.getproduct.id;
    request.value.productdescription = requestt.productdescription;
    if (requestt.getsupplier != null) {
        request.value.suppliername = requestt.getsupplier;
    } else {
        request.value.suppliername = "";
    }
    if (requestt.getuser != null) {
        request.value.clientname = requestt.getuser;
    } else {
        request.value.clientname = "";
    }
    if (requestt.client_id != null) {
        request.value.client_id = requestt.client_id;
    } else {
        request.value.client_id = "";
    }

    request.value.quantity = requestt.quantity;
    $("#detailsmodal").modal("show");
};
const handleimage = (event) => {
    const file = event.target.files[0];

    request.value.image = file;
};
const submitform = () => {
    loading.value = true;
    axios
        .put(`/request/${requestidvalue.value}`, request.value)
        .then((response) => {
            $("#editformmodal").modal("hide");
            toaster.success("Request Send Successfully");
            const index = allrequest.value.findIndex(
                (request) => request.id === response.data.request.id
            );

            allrequest.value[index] = response.data.request;

            if (errors.value != null) {
                errors.value = null;
            }
            loading.value = false;
        })
        .catch((error) => {
            // errors.value = error.response.data.errors;
            loading.value = false;
        });
};
onMounted(() => {
    getallrequest();
    getusers();
    getproduct();
});
</script>
