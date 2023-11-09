<script setup>
import { handleError, onMounted, reactive, ref, watch } from "vue";
import { Form, Field, useSetFieldError } from "vee-validate";
import * as yup from "yup";
import { usetoaster } from "../../../../toaster.js";
import { Bootstrap4Pagination } from "laravel-vue-pagination";
import axios from "axios";
import moment from "moment";
const format = window.Laravel.format;
const user = window.Laravel.user;

const reload = ref(false);
const roles = ref([
    {
        name: "Admin",
        value: "ADMIN",
    },
    {
        name: "USER",
        value: "USER",
    },
    {
        name: "CLIENT",
        value: "CLIENT",
    },
    {
        name: "DOCTOR",
        value: "DOCTOR",
    },
    {
        name: "SUPPLIER",
        value: "SUPPLIER",
    },
]);
const toaster = usetoaster();
const formValues = ref();
const users = ref([]);
const edit = ref(false);
const formdata = ref(null);
const searchquery = ref(null);
const search = () => {
    axios
        .get("/api/users/search", {
            params: { query: searchquery.value },
        })
        .then((response) => {
            users.value.data = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
const form = reactive({
    name: "",
    phone: "",
    city: "",
    clinicname: "",
    address: "",
    role: "",
    location: "",
    packages: "",
    email: "",
    password: "",
});
const changeRole = (user, role) => {
    axios
        .patch(`/api/users/${user.id}/change-role`, {
            role: role,
        })
        .then((response) => {
            toaster.success("Role Changed Successfuly");
        });
};
const getusers = (page = 1) => {
    reload.value = true;
    axios.get(`/api/users?page=${page}`).then((response) => {
        users.value = response.data;
        reload.value = false;
    });
};
const useridbeingDelete = ref(null);
// const createuser = () => {
//     axios.post("/api/users", form).then((response) => {
//         users.value.unshift(response.data);
//         (form.name = ""),
//             (form.phone = ""),
//             (form.city = ""),
//             (form.clinicname = ""),
//             (form.address = ""),
//             (form.role = ""),
//             (form.location = ""),
//             (form.packages = ""),
//             (form.email = ""),
//             (form.password = "");
//         $("#userformmodal").modal("hide");
//     });
// };
const creatusereschema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().required().min(8),
});

const edituserschema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    // password: yup.string().min(8),
});

const createuser = (values, { resetForm, setErrors }) => {
    axios
        .post("/api/users", values)
        .then((response) => {
            users.value.data.unshift(response.data);
            $("#userformmodal").modal("hide");
            resetForm();
            toaster.success("User Created successfully!");
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        });
};

const addnewuser = () => {
    edit.value = false;
    formdata.value.resetForm();
    $("#userformmodal").modal("show");
};

const edituser = (user) => {
    edit.value = true;
    formdata.value.resetForm();
    $("#userformmodal").modal("show");
    formValues.value = user;
};
const deleteuser = (user) => {
    useridbeingDelete.value = user.id;

    $("#deleteModal").modal("show");
};
const confirmdelete = () => {
    axios
        .delete(`/api/users/delete/${useridbeingDelete.value}`)
        .then((response) => {
            users.value.data = users.value.data.filter(
                (user) => user.id !== useridbeingDelete.value
            );
            // const index = users.value.findIndex(
            //     (user) => user.id === response.data.id
            // );
            // users.value[index] = response.data;
            $("#deleteModal").modal("hide");
            toaster.success("User deleted successfully!");
        });
};
const updateuser = (values, { setErrors }) => {
    axios
        .put("/api/users/update/" + formValues.value.id, values)
        .then((response) => {
            const index = users.value.data.findIndex(
                (user) => user.id === response.data.id
            );
            users.value.data[index] = response.data;
            $("#userformmodal").modal("hide");
            toaster.success("User updated successfully!");
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        })
        .finally(() => {
            formdata.value.resetForm();
        });
};
const handlesubmit = (values, action) => {
    if (edit.value) {
        updateuser(values, action);
    } else {
        createuser(values, action);
    }
};
watch(searchquery, () => {
    search();
});
onMounted(() => {
    getusers();
});
</script>

<template>
    <div
        v-if="reload"
        class="spinner-grow text-danger"
        style="margin-left: 50%; margin-top: 25%"
        role="status"
    >
        <!-- <span class="visually-hidden">Loading...</span> -->
    </div>
    <div v-if="!reload">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="wrapper">
                    <!-- Content Wrapper. Contains page content -->
                    <section class="content" v-if="user.role == 'ADMIN'">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div
                                        class="pl-5 pr-5 pt-4 d-flex align-items-center justify-content-between"
                                    >
                                        <div class="d-flex align-items-center">
                                            <h3 class="card-title mr-3">
                                                All users
                                            </h3>
                                            <div>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="search ..."
                                                    v-model="searchquery"
                                                />
                                                <!-- <button
                                                    @click.prevent="search"
                                                    type="submit"
                                                >
                                                    submit
                                                </button> -->
                                            </div>
                                        </div>
                                        <div v-if="user.role == 'ADMIN'">
                                            <button
                                                class="btn btn-danger"
                                                @click="addnewuser"
                                            >
                                                Add new User
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>name</th>
                                                    <th>email</th>
                                                    <th>role</th>
                                                    <th>created at</th>

                                                    <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        userr, index
                                                    ) in users.data"
                                                    :key="user.id"
                                                >
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ userr.name }}</td>
                                                    <td>{{ userr.email }}</td>
                                                    <td>
                                                        <select
                                                            class="form-control"
                                                            @change="
                                                                changeRole(
                                                                    userr,
                                                                    $event
                                                                        .target
                                                                        .value
                                                                )
                                                            "
                                                        >
                                                            <option
                                                                v-for="role in roles"
                                                                :value="
                                                                    role.value
                                                                "
                                                                :selected="
                                                                    userr.role ===
                                                                    role.value
                                                                "
                                                            >
                                                                {{ role.name }}
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        {{
                                                            moment(
                                                                userr.created_at
                                                            ).format(format)
                                                        }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            v-if="
                                                                user.role ==
                                                                'ADMIN'
                                                            "
                                                        >
                                                            <a
                                                                class="mr-4"
                                                                href="#"
                                                                @click="
                                                                    edituser(
                                                                        userr
                                                                    )
                                                                "
                                                                ><i
                                                                    class="fas fa-pen text-white bg-primary rounded p-1"
                                                                ></i
                                                            ></a>
                                                            <a
                                                                href="#"
                                                                @click="
                                                                    deleteuser(
                                                                        user
                                                                    )
                                                                "
                                                                ><i
                                                                    class="fas fa-trash text-danger"
                                                                ></i
                                                            ></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <tbody v-if="users.data == 0">
                                                <tr>
                                                    No results Found
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <Bootstrap4Pagination
                                    :data="users"
                                    @pagination-change-page="getusers"
                                />
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
            id="userformmodal"
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
                            v-if="edit"
                            class="modal-title"
                            id="exampleModalLabel"
                            style="font-weight: bold"
                        >
                            Edit User
                        </h5>
                        <h5
                            v-else
                            class="modal-title"
                            id="exampleModalLabel"
                            style="font-weight: bold"
                        >
                            Add User
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
                    <Form
                        @submit="handlesubmit"
                        :validation-schema="
                            edit ? edituserschema : creatusereschema
                        "
                        v-slot="{ errors }"
                        :initial-values="formValues"
                        ref="formdata"
                    >
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <Field
                                        type="email"
                                        class="form-control"
                                        id="inputEmail4"
                                        name="email"
                                        v-model="form.email"
                                        placeholder="Email"
                                        :class="{ 'is-invalid': errors.email }"
                                    />
                                    <span class="invalid-feedback">{{
                                        errors.email
                                    }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Password</label>
                                    <Field
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        id="inputPassword4"
                                        :class="{
                                            'is-invalid': errors.password,
                                        }"
                                        v-model="form.password"
                                        placeholder="Password"
                                    />
                                    <span class="invalid-feedback">{{
                                        errors.password
                                    }}</span>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <Field
                                type="text"
                                name="address"
                                class="form-control"
                                id="inputAddress"
                                v-model="form.address"
                                placeholder="1234 Main St"
                            />
                        </div>
                        <div class="form-group">
                            <label for="inputCity">City</label>
                            <Field
                                type="text"
                                name="city"
                                class="form-control"
                                v-model="form.city"
                                id="inputCity"
                            />
                        </div> -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputname4">name</label>
                                    <Field
                                        type="text"
                                        class="form-control"
                                        id="inputname4"
                                        name="name"
                                        v-model="form.name"
                                        placeholder="Your Name"
                                        :class="{ 'is-invalid': errors.name }"
                                    />
                                    <span class="invalid-feedback">{{
                                        errors.name
                                    }}</span>
                                </div>

                                <!-- <div class="form-group col-md-6">
                                <label for="inputAddress2">Phone</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    id="inputAddress2"
                                    v-model="form.phone"
                                    placeholder="Apartment, studio, or floor"
                                />
                            </div> -->
                            </div>

                            <!-- <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select
                                    id="role"
                                    class="form-control"
                                    name="role"
                                >
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="package">packages</label>
                                <select
                                    id="package"
                                    class="form-control"
                                    name="package"
                                >
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div> -->
                        </div>
                        <div class="modal-footer">
                            <button
                                v-if="!edit"
                                type="submit"
                                class="btn btn-primary"
                            >
                                Save
                            </button>
                            <button
                                v-if="edit"
                                type="submit"
                                class="btn btn-primary"
                            >
                                Edit
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                        </div>
                    </Form>
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
                            Delete User
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
                            Are you sure you want to delete this user?
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click.prevent="confirmdelete"
                            type="submit"
                            class="btn btn-danger"
                        >
                            Delete User
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
    </div>
</template>
