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
                                    <div class="">
                                        <button
                                            v-if="user.role == 'ADMIN'"
                                            class="btn btn-danger"
                                            @click="addproductmodalfun"
                                        >
                                            Add Product
                                            <i
                                                class="fas fa-plus ml-2 mr-2"
                                            ></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Product Name</th>
                                                <th>Product ID</th>
                                                <th>Group Name</th>
                                                <th class="text-center">
                                                    Stock in Qty
                                                </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    productitem, index
                                                ) in Allproduct"
                                                :key="productitem.id"
                                            >
                                                <td>{{ index + 1 }}</td>
                                                <td v-if="user.role == 'ADMIN'">
                                                    {{
                                                        productitem.productname
                                                    }}
                                                </td>
                                                <td v-if="user.role == 'USER'">
                                                    {{
                                                        productitem.getproduct
                                                            .productname
                                                    }}
                                                </td>
                                                <td v-if="user.role == 'ADMIN'">
                                                    {{
                                                        productitem.productcode
                                                    }}
                                                </td>
                                                <td v-if="user.role == 'USER'">
                                                    {{
                                                        productitem.getproduct
                                                            .productcode
                                                    }}
                                                </td>
                                                <td v-if="user.role == 'ADMIN'">
                                                    <div
                                                        v-for="groupitem in group"
                                                        :key="groupitem.id"
                                                    >
                                                        <p
                                                            v-if="
                                                                groupitem.id ==
                                                                productitem.group
                                                            "
                                                        >
                                                            {{
                                                                groupitem.Groupname
                                                            }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td v-if="user.role == 'USER'">
                                                    <div
                                                        v-for="groupitem in group"
                                                        :key="groupitem.id"
                                                    >
                                                        <p
                                                            v-if="
                                                                groupitem.id ==
                                                                productitem
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
                                                        productitem.Qty <= 10 &&
                                                        user.role == 'ADMIN'
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
                                                        {{ productitem.Qty }}
                                                    </p>
                                                </td>

                                                <td
                                                    v-if="
                                                        productitem.Qty > 10 &&
                                                        productitem.Qty <= 20 &&
                                                        user.role == 'ADMIN'
                                                    "
                                                    class="text-center"
                                                >
                                                    <p
                                                        style="
                                                            margin: auto;
                                                            width: 110px;
                                                            background-color: #fff3b2;
                                                            color: rgb(0, 0, 0);
                                                            border-radius: 25px;
                                                        "
                                                    >
                                                        {{ productitem.Qty }}
                                                    </p>
                                                </td>

                                                <td
                                                    v-if="
                                                        productitem.Qty > 20 &&
                                                        user.role == 'ADMIN'
                                                    "
                                                    class="text-center"
                                                >
                                                    <p
                                                        style="
                                                            margin: auto;
                                                            width: 110px;
                                                            background-color: #c4ffd1;
                                                            color: rgb(0, 0, 0);
                                                            border-radius: 25px;
                                                        "
                                                    >
                                                        {{ productitem.Qty }}
                                                    </p>
                                                </td>

                                                <!--------->
                                                <td
                                                    class="text-center"
                                                    v-if="
                                                        productitem.Quantity <=
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
                                                            productitem.Quantity
                                                        }}
                                                    </p>
                                                </td>

                                                <td
                                                    v-if="
                                                        productitem.Quantity >
                                                            10 &&
                                                        productitem.Quantity <=
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
                                                            color: rgb(0, 0, 0);
                                                            border-radius: 25px;
                                                        "
                                                    >
                                                        {{
                                                            productitem.Quantity
                                                        }}
                                                    </p>
                                                </td>

                                                <td
                                                    v-if="
                                                        productitem.Quantity >
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
                                                            color: rgb(0, 0, 0);
                                                            border-radius: 25px;
                                                        "
                                                    >
                                                        {{
                                                            productitem.Quantity
                                                        }}
                                                    </p>
                                                </td>

                                                <td>
                                                    <div
                                                        v-if="
                                                            user.role == 'ADMIN'
                                                        "
                                                    >
                                                        <a
                                                            class="mr-4"
                                                            href="#"
                                                            @click.prevent="
                                                                addQuantity(
                                                                    productitem
                                                                )
                                                            "
                                                            ><i
                                                                class="fas fa-plus text-white bg-success rounded p-1"
                                                            ></i
                                                        ></a>
                                                        <a
                                                            class="mr-4"
                                                            href="#"
                                                            @click.prevent="
                                                                editproduct(
                                                                    productitem
                                                                )
                                                            "
                                                            ><i
                                                                class="fas fa-pen text-white bg-primary rounded p-1"
                                                            ></i
                                                        ></a>
                                                        <a
                                                            v-if="
                                                                user.role ==
                                                                'ADMIN'
                                                            "
                                                            @click.prevent="
                                                                deleteprodut(
                                                                    productitem.id
                                                                )
                                                            "
                                                            href="#"
                                                            ><i
                                                                class="fas fa-trash text-danger"
                                                            ></i
                                                        ></a>
                                                    </div>
                                                    <div
                                                        v-if="
                                                            user.role == 'USER'
                                                        "
                                                    >
                                                        <a
                                                            class="mr-4"
                                                            href="#"
                                                            @click.prevent="
                                                                editproduct(
                                                                    productitem
                                                                )
                                                            "
                                                            ><i
                                                                class="fas fa-pen text-white bg-primary rounded p-1"
                                                            ></i
                                                        ></a>
                                                        <a
                                                            @click.prevent="
                                                                deleteprodut(
                                                                    productitem.id
                                                                )
                                                            "
                                                            href="#"
                                                            ><i
                                                                class="fas fa-trash text-danger"
                                                            ></i
                                                        ></a>
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
    <div id="addproductmodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        v-if="updat && user.role == 'ADMIN'"
                        class="modal-title"
                    >
                        update product
                    </h5>
                    <h5
                        v-else-if="updat && user.role == 'USER'"
                        class="modal-title"
                    >
                        send product
                    </h5>

                    <h5 v-else class="modal-title">Add new product</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form v-if="updat" @submit.prevent="updatenow">
                    <p class="text-danger">
                        {{ erorsenduser }}
                    </p>

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Product name</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.productname"
                                    name="productname"
                                    :disabled="user.role === 'USER'"
                                    id="productname"
                                    placeholder="Enter product
                                name"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid">Product Id</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.productcode"
                                    :disabled="user.role === 'USER'"
                                    name="productcode"
                                    id="productid"
                                    placeholder="Enter product id"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Group name</label>
                                <select
                                    name="group_id"
                                    v-model="product.group_id"
                                    :disabled="user.role === 'USER'"
                                    class="form-control"
                                >
                                    <option hidden value="">
                                        Group name not selectd
                                    </option>
                                    <option
                                        v-for="groupitem in group"
                                        :key="groupitem.id"
                                        :value="groupitem.id"
                                    >
                                        {{ groupitem.Groupname }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid"
                                    >Quantity available</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.qty"
                                    name="qty"
                                    id="productid"
                                    placeholder="Enter product id"
                                />
                            </div>
                            <div
                                v-if="user.role === 'ADMIN'"
                                class="form-group col-md-6"
                            >
                                <label for="productprice">product price</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.price"
                                    name="price"
                                    id="productprice"
                                    placeholder="Enter product Price R.S"
                                />
                            </div>
                        </div>

                        <input type="hidden" v-model="product.product_id" />
                        <div class="form-row" v-if="user.role === 'USER'">
                            <div class="form-group col-md-6">
                                <label for="productname">Send to clinic</label>
                                <select
                                    name="group_id"
                                    v-model="product.clinic"
                                    class="form-control"
                                >
                                    <option hidden selected value="">
                                        choose your clinic
                                    </option>
                                    <option
                                        v-for="clinic in allclincs"
                                        :key="clinic.id"
                                        :value="clinic.id"
                                    >
                                        {{ clinic.clinicname }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-if="user.role == 'ADMIN'"
                            type="submit"
                            class="btn btn-danger"
                        >
                            update product
                        </button>
                        <button
                            v-if="user.role == 'USER'"
                            type="submit"
                            class="btn btn-danger"
                        >
                            send product
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
                <form v-else @submit.prevent="insertnewproduct">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Product name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="product.productname"
                                    name="productname"
                                    id="productname"
                                    placeholder="Enter product name"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid">Product Id</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.productcode"
                                    name="productcode"
                                    id="productid"
                                    placeholder="Enter product id"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="productname">Group name</label>
                                <select
                                    name="group_id"
                                    v-model="product.group_id"
                                    class="form-control"
                                >
                                    <option hidden value="">
                                        Group name notselectd
                                    </option>
                                    <option
                                        v-for="groupitem in group"
                                        :key="groupitem.id"
                                        :value="groupitem.id"
                                    >
                                        {{ groupitem.Groupname }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productid"
                                    >Quantity available</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.qty"
                                    name="qty"
                                    id="productid"
                                    placeholder="Enter product id"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="productprice">product price</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.price"
                                    name="price"
                                    id="productprice"
                                    placeholder="Enter product Price R.S"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Add product
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

    <div id="addquantitymodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Quantity</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="addQuantitynow">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="productid"
                                    >Quantity available</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="product.qty"
                                    name="qty"
                                    id="productid"
                                    placeholder="Add Quantity here"
                                />
                            </div>
                        </div>

                        <input type="hidden" v-model="product.product_id" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Add Quantity
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
</template>
<script setup>
import { onMounted, reactive, ref } from "vue";
import { usetoaster } from "../../../../toaster.js";
import axios from "axios";
const user = window.Laravel.user;
const toaster = usetoaster();
const allclincs = ref([]);

const product = reactive({
    product_id: "",
    productname: "",
    productcode: "",
    group_id: "",
    qty: "",
    price: "",
    clinic: "",
});

const Allproduct = ref([]);
const props = defineProps(["Allproduct"]);

const updat = ref(false);
const group = ref([]);

const addproductmodalfun = () => {
    updat.value = false;
    product.productname = "";
    product.productcode = "";
    product.group_id = "";
    product.price = "";
    product.qty = "";
    getgroup();
    $("#addproductmodal").modal("show");
};
const getgroup = () => {
    axios.get("/group").then((response) => {
        group.value = response.data;
    });
};
const notfond = ref();
const getclinics = () => {
    const user = window.Laravel.user;
    axios.get(`/api/clinics/${user.id}`).then((response) => {
        allclincs.value = response.data;
        if (response.data.length < 1) {
            notfond.value = "You do not have any product until yet";
        } else {
            allclincs.value = response.data;
        }
    });
};
const productid = ref();
const prodqty = ref();
const addQuantity = (productitem) => {
    prodqty.value = productitem;
    product.qty = productitem.Qty;
    $("#addquantitymodal").modal("show");
};
const addQuantitynow = () => {
    if (product.qty < prodqty.value.Qty) {
        alert(`Sorry Quantity must be greater than ${prodqty.value.Qty} `);
    } else {
        const quantity = {
            productid: prodqty.value.id,
            Quantity: product.qty,
        };
        axios.patch("/product/addquantity", quantity).then((response) => {
            console.log(response.data);
            $("#addquantitymodal").modal("hide");
            const index = Allproduct.value.findIndex(
                (product) => product.id === response.data.id
            );
            Allproduct.value[index] = response.data;
            toaster.success("quantity added Successfuly");
        });
    }
};

const editproduct = (prooduct) => {
    updat.value = true;
    productid.value = prooduct.id;
    if (user.role == "USER") {
        product.productname = prooduct.getproduct.productname;
        product.productcode = prooduct.getproduct.productcode;
        product.group_id = prooduct.getproduct.group;
        product.qty = prooduct.Quantity;
        product.clinic = prooduct.clinic;
        product.product_id = prooduct.id;
    } else {
        product.productname = prooduct.productname;
        product.productcode = prooduct.productcode;
        product.price = prooduct.price;

        product.group_id = prooduct.group;
        product.qty = prooduct.Qty;
    }
    getgroup();
    $("#addproductmodal").modal("show");
};
const erorsenduser = ref("");
const updatenow = () => {
    if (user.role == "USER") {
        if (!product.qty || !product.clinic) {
            erorsenduser.value =
                "Please fill in the required fields Quantity or clinic";
        } else {
            axios
                .put(`/inventoryuser/update/${productid.value}`, product)
                .then((response) => {
                    $("#addproductmodal").modal("hide");
                    if (response.data.erroor) {
                        toaster.error(response.data.erroor);
                    } else {
                        const index = Allproduct.value.findIndex(
                            (product) => product.id === response.data.product.id
                        );
                        Allproduct.value[index] = response.data.product;
                        toaster.success("product send Successfuly");
                    }
                });
        }
    } else {
        axios
            .put(`/product/update/${productid.value}`, product)
            .then((response) => {
                const index = Allproduct.value.findIndex(
                    (product) => product.id === response.data.id
                );
                Allproduct.value[index] = response.data;
                $("#addproductmodal").modal("hide");
                toaster.success("product updated Successfuly");
            });
    }
};
const getproduct = () => {
    axios.get(`/productperuser/${user.id}`).then((response) => {
        Allproduct.value = response.data;
    });
};

const insertnewproduct = () => {
    axios.post("/product", product).then((response) => {
        $("#addproductmodal").modal("hide");
        Allproduct.value.unshift(response.data);
        toaster.success("product Added Successfuly");
    });
};
const deleteprodut = (id) => {
    axios.delete(`/product/delete/${id}`).then((response) => {
        Allproduct.value = Allproduct.value.filter(
            (product) => product.id !== id
        );
        toaster.success("product deleted successfully!");
    });
};

onMounted(() => {
    getproduct();
    getgroup();
    getclinics();
});
</script>
