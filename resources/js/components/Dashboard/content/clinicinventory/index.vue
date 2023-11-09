<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome To Med-Verse</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Inventory</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div v-if="errorr">
        <h3 class="text-danger text-center">{{ errorr }}</h3>
    </div>
    <div v-else>
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
                                        <h5>All Product</h5>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table" v-if="inventory.length > 0">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Product Name</th>
                                                    <th>Product ID</th>
                                                    <th>Group Name</th>
                                                    <th>Stock in Qty</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <tr
                                                    v-for="(
                                                        inventor, index
                                                    ) in inventory"
                                                    :key="inventor.id"
                                                >
                                                    <td>{{ index + 1 }}</td>
                                                    <td>
                                                        {{
                                                            inventor.getproduct
                                                                .productname
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            inventor.getproduct
                                                                .productcode
                                                        }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            v-for="groupitem in group"
                                                            :key="groupitem.id"
                                                        >
                                                            <p
                                                                v-if="
                                                                    groupitem.id ==
                                                                    inventor
                                                                        .getproduct
                                                                        .group
                                                                "
                                                            >
                                                                {{
                                                                    groupitem.Groupname
                                                                }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="text-center"
                                                        v-if="
                                                            inventor.Quantity <=
                                                                10 &&
                                                            user.role == 'USER'
                                                        "
                                                    >
                                                        <p
                                                            style="
                                                                margin: auto;
                                                                width: 110px;
                                                                background-color: #ffabab;
                                                                color: rgb(
                                                                    144,
                                                                    0,
                                                                    0
                                                                );
                                                                border-radius: 25px;
                                                            "
                                                        >
                                                            {{
                                                                inventor.Quantity
                                                            }}
                                                        </p>
                                                    </td>

                                                    <td
                                                        v-if="
                                                            inventor.Quantity >
                                                                10 &&
                                                            inventor.Quantity <=
                                                                20 &&
                                                            user.role == 'USER'
                                                        "
                                                        class="text-center"
                                                    >
                                                        <p
                                                            style="
                                                                margin: auto;
                                                                width: 110px;
                                                                background-color: #fff3b2;
                                                                color: rgb(
                                                                    0,
                                                                    0,
                                                                    0
                                                                );
                                                                border-radius: 25px;
                                                            "
                                                        >
                                                            {{
                                                                inventor.Quantity
                                                            }}
                                                        </p>
                                                    </td>

                                                    <td
                                                        v-if="
                                                            inventor.Quantity >
                                                                20 &&
                                                            user.role == 'USER'
                                                        "
                                                        class="text-center"
                                                    >
                                                        <p
                                                            style="
                                                                margin: auto;
                                                                width: 110px;
                                                                background-color: #c4ffd1;
                                                                color: rgb(
                                                                    0,
                                                                    0,
                                                                    0
                                                                );
                                                                border-radius: 25px;
                                                            "
                                                        >
                                                            {{
                                                                inventor.Quantity
                                                            }}
                                                        </p>
                                                    </td>

                                                    <td
                                                        v-if="
                                                            inventor.Quantity ==
                                                            0
                                                        "
                                                    >
                                                        <div
                                                            v-if="
                                                                user.role ==
                                                                'USER'
                                                            "
                                                        >
                                                            <a
                                                                @click.prevent="
                                                                    deleteprodut(
                                                                        inventor.id
                                                                    )
                                                                "
                                                                href="#"
                                                                ><i
                                                                    class="fas fa-trash text-danger"
                                                                ></i
                                                            ></a>
                                                        </div>
                                                    </td>
                                                    <td
                                                        v-if="
                                                            inventor.Quantity >
                                                            0
                                                        "
                                                    >
                                                        <div
                                                            class="quantity-toggle d-flex"
                                                        >
                                                            <button
                                                                class="btn btn-danger"
                                                                @click.prevent="
                                                                    decrement(
                                                                        inventor.id
                                                                    )
                                                                "
                                                            >
                                                                &mdash;
                                                            </button>
                                                            <input
                                                                class="bg-danger btn btn-danger"
                                                                type="text"
                                                                style="
                                                                    width: 70px;
                                                                "
                                                                :value="
                                                                    inventor.Quantity
                                                                "
                                                                readonly
                                                            />
                                                            <button
                                                                class="btn btn-danger"
                                                                @click.prevent="
                                                                    increment(
                                                                        inventor.id
                                                                    )
                                                                "
                                                            >
                                                                &#xff0b;
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                       
                                        </table>
                                        <p v-else>
                                                <div
                                                    class="text-danger text-center"
                                                >
                                                    you don't have any product
                                                    until yet
                                                </div>
                                            </p>
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
    </div>
</template>
<script setup>
import axios, { Axios } from "axios";
import { defineProps, onMounted, ref } from "vue";
import { usetoaster } from "../../../../toaster.js";
const user = window.Laravel.user;
const inventory = ref([]);
const group = ref();
const errorr = ref();
const toaster = usetoaster();
const props = defineProps({
    clinic_id: Number,
    required: true,
});
const deleteprodut = (id) => {
    axios.delete(`/api/clinicproduct/delete/${id}`).then((response) => {
        inventory.value = inventory.value.filter(
            (product) => product.id !== id
        );
        toaster.success("product deleted successfully!");
    });
};
const getclinicinventory = () => {
    axios.get(`/api/clinicinventory/${props.clinic_id}`).then((response) => {
        if (response.data.erroor) {
            errorr.value = response.data.erroor;
        } else {
            inventory.value = response.data;
        }
    });
};
const getgroup = () => {
    axios.get(`/group`).then((response) => {
        group.value = response.data;
    });
};
const clinicproduct = ref();
const decrement = (id) => {
    axios.get(`/clinicproduct/${id}`).then((response) => {
       
        clinicproduct.value = response.data;
                if (clinicproduct.value.Quantity <= 0) {
            alert("Sorry You don't have enough Quantity");
        } else {
             clinicproduct.value.Quantity--;
            axios
                .patch(`/api/clinicproduct/${id}/change-quantity`, {
                    quantity: clinicproduct.value.Quantity,
                })
                .then((response) => { 
                    console.log(response);
                    const index = inventory.value.findIndex(
                        (product) => product.id === response.data.id
                    );
                    inventory.value[index].Quantity = response.data.Quantity;
                    toaster.success("quantity changed successfully!");
                });
        }
    });
};
var increment = (id) => {
    axios.get(`/clinicproduct/${id}`).then((response) => {
        clinicproduct.value = response.data;
        if (clinicproduct.value.Quantity === clinicproduct.value.Quantity) {
            alert(`Sorry You have ${clinicproduct.value.Quantity} only`);
        } else {
            clinicproduct.value.Quantity++;
            axios
                .patch(`/api/clinicproduct/${id}/change-role`, {
                    quantity: clinicproduct.value.Quantity,
                })
                .then((response) => {
                    const index = inventory.value.findIndex(
                        (product) => product.id === response.data.id
                    );
                    inventory.value[index].Quantity = response.data.Quantity;
                    toaster.success("quantity changed successfully!");
                });
        }
    });
};
onMounted(() => {
    getclinicinventory();
    getgroup();
});
</script>
