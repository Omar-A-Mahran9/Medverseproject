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
                                                All Requests
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
                                                    <th>Quotation Statue</th>
                                                    <th>Is Delivered</th>
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
                                                            >Details</span
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
                                                        <div
                                                            v-if="
                                                                request.qutation
                                                            "
                                                        >
                                                            <p
                                                                @click="
                                                                    toggleShowComment
                                                                "
                                                                style="
                                                                    cursor: pointer;
                                                                "
                                                            >
                                                                {{
                                                                    request
                                                                        .qutation
                                                                        .statue
                                                                }}
                                                            </p>

                                                            <p
                                                                v-if="
                                                                    show_comment
                                                                "
                                                            >
                                                                {{
                                                                    request
                                                                        .qutation
                                                                        .refuse_comment
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div v-else>
                                                            Not have Quotation
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <input
                                                            type="checkbox"
                                                            v-model="
                                                                request.is_Delivered
                                                            "
                                                            v-if="
                                                                request.is_Delivered ==
                                                                    0 &&
                                                                request.statue ==
                                                                    'ACCEPTED' &&
                                                                !currentuseradmin &&
                                                                currentuser.role !=
                                                                    'SUPPLIER'
                                                            "
                                                            @change="
                                                                is_delivery(
                                                                    request,
                                                                    $event
                                                                        .target
                                                                        .value
                                                                )
                                                            "
                                                            id="customSwitch3"
                                                        />
                                                        <p
                                                            v-if="
                                                                currentuseradmin ||
                                                                (currentuser.role ==
                                                                    'SUPPLIER' &&
                                                                    request.is_Delivered ==
                                                                        0)
                                                            "
                                                        >
                                                            Not Delivered
                                                        </p>
                                                        <p
                                                            v-if="
                                                                request.is_Delivered ==
                                                                1
                                                            "
                                                        >
                                                            Delivered
                                                        </p>
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

                                                    <div
                                                        id="showQuotation"
                                                        class="modal fade"
                                                        tabindex="-1"
                                                        role="dialog"
                                                        aria-labelledby="myLargeModalLabel"
                                                        aria-hidden="true"
                                                    >
                                                        <div
                                                            class="modal-dialog modal-lg"
                                                        >
                                                            <div
                                                                class="modal-content"
                                                            >
                                                                <div
                                                                    class="modal-header"
                                                                >
                                                                    <h5
                                                                        class="modal-title"
                                                                        id="exampleModalLabel"
                                                                        style="
                                                                            font-weight: bold;
                                                                        "
                                                                    >
                                                                        Send
                                                                        Quotation
                                                                    </h5>

                                                                    <button
                                                                        type="button"
                                                                        class="close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close"
                                                                    >
                                                                        <span
                                                                            aria-hidden="true"
                                                                            class="text-danger"
                                                                            >&times;</span
                                                                        >
                                                                    </button>
                                                                </div>

                                                                <div
                                                                    class="modal-body"
                                                                >
                                                                    <div
                                                                        class="form-row"
                                                                    >
                                                                        <div
                                                                            class="col-6 form-group"
                                                                        >
                                                                            <label
                                                                                for="inputName"
                                                                                class="col-form-label"
                                                                                >Taxes</label
                                                                            >
                                                                            <div
                                                                                class=" "
                                                                            >
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    v-model="
                                                                                        Quotation.Taxes
                                                                                    "
                                                                                    id="inputName"
                                                                                    placeholder="Tax"
                                                                                />
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="col-6 form-group"
                                                                        >
                                                                            <label
                                                                                for="inputName"
                                                                                class="col-form-label"
                                                                                >Delivery
                                                                                Salary</label
                                                                            >
                                                                            <div
                                                                                class=" "
                                                                            >
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    v-model="
                                                                                        Quotation.Delivery
                                                                                    "
                                                                                    id="inputName"
                                                                                    placeholder="Delivery"
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="modal-footer"
                                                                >
                                                                    <button
                                                                        @click.prevent="
                                                                            CreateQuotation(
                                                                                request
                                                                            )
                                                                        "
                                                                        type="submit"
                                                                        class="btn btn-danger"
                                                                    >
                                                                        Send Now
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
                            <h5 class="text-info">Request Information:</h5>
                            <div>
                                <p style="font-weight: bold">
                                    Request by :
                                    <span style="font-weight: normal">{{
                                        request.getuser.name
                                    }}</span>
                                </p>
                            </div>
                            <div>
                                <p style="font-weight: bold">
                                    {{ request.getuser.name }} position :
                                    <span style="font-weight: normal">{{
                                        request.getuser.position
                                    }}</span>
                                </p>
                            </div>
                            <div>
                                <p style="font-weight: bold">
                                    {{ request.getuser.name }} phone:
                                    <span style="font-weight: normal">{{
                                        request.getuser.phone
                                    }}</span>
                                </p>
                            </div>
                            <div>
                                <p style="font-weight: bold">
                                    {{ request.getuser.name }} email:
                                    <span style="font-weight: normal">{{
                                        request.getuser.email
                                    }}</span>
                                </p>
                            </div>
                            <div>
                                <p style="font-weight: bold">
                                    Request Date:
                                    <span style="font-weight: normal">
                                        {{
                                            moment(request.created_at).format(
                                                "YYYY-MM-DD HH:mm:ss a"
                                            )
                                        }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div
                                v-if="
                                    currentuseradmin
                                    // request.clientname == null
                                "
                            >
                                <h5 class="text-info">Send To:</h5>

                                <div>
                                    <div>
                                        <p style="font-weight: bold">
                                            Clientname:
                                            <span style="font-weight: normal">
                                                <span
                                                    v-if="
                                                        request.clientname ==
                                                        null
                                                    "
                                                >
                                                    {{ request.getuser.name }}
                                                </span>
                                                <span
                                                    v-if="
                                                        request.clientname !=
                                                        null
                                                    "
                                                >
                                                    {{
                                                        request.clientname.name
                                                    }}
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p style="font-weight: bold">
                                            Client phone:
                                            <span style="font-weight: normal">
                                                <span
                                                    v-if="
                                                        request.clientname ==
                                                        null
                                                    "
                                                >
                                                    {{ request.getuser.phone }}
                                                </span>
                                                <span
                                                    v-if="
                                                        request.clientname !=
                                                        null
                                                    "
                                                >
                                                    {{
                                                        request.clientname.phone
                                                    }}
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p style="font-weight: bold">
                                            Client Email:
                                            <span style="font-weight: normal">
                                                <span
                                                    v-if="
                                                        request.clientname ==
                                                        null
                                                    "
                                                >
                                                    {{ request.getuser.email }}
                                                </span>
                                                <span
                                                    v-if="
                                                        request.clientname !=
                                                        null
                                                    "
                                                >
                                                    {{
                                                        request.clientname.email
                                                    }}
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p style="font-weight: bold">
                                            Client Address:
                                            <span style="font-weight: normal">
                                                <span
                                                    v-if="
                                                        request.clientname ==
                                                        null
                                                    "
                                                >
                                                    {{
                                                        request.getuser.Address
                                                    }}
                                                </span>
                                                <span
                                                    v-if="
                                                        request.clientname !=
                                                        null
                                                    "
                                                >
                                                    {{
                                                        request.clientname
                                                            .Address
                                                    }}
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <p style="font-weight: bold">
                                            Client City:
                                            <span style="font-weight: normal">
                                                <span
                                                    v-if="
                                                        request.clientname ==
                                                        null
                                                    "
                                                >
                                                    {{ request.getuser.city }}
                                                </span>
                                                <span
                                                    v-if="
                                                        request.clientname !=
                                                        null
                                                    "
                                                >
                                                    {{
                                                        request.clientname.city
                                                    }}
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="!currentuseradmin"
                                class="d-flex flex-column justify-content-center"
                            >
                                <p v-if="havequtation == false">
                                    you will receive quotation from admin to
                                    submit your Request then your request will
                                    be applied during 3 working days
                                </p>

                                <button
                                    v-if="
                                        havequtation &&
                                        (!currentuseradmin || currentuser)
                                    "
                                    @click="showQuotation(request)"
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    view Quotation
                                </button>
                                <button
                                    v-else
                                    type="submit"
                                    class="btn btn-danger"
                                    disabled
                                >
                                    view Quotation
                                </button>
                            </div>
                            <!-- <div
                                v-if="
                                    currentuseradmin &&
                                    request.clientname != null
                                "
                                class="text-center"
                            >
                                <p>
                                    Once You accept Request directly products
                                    will be send to
                                    <strong>{{
                                        request.clientname.name
                                    }}</strong>
                                </p>
                            </div> -->
                        </div>
                        <div class="col-12" v-if="currentuser">
                            <h5 class="text-info text-bold text-center">
                                All products
                            </h5>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">product name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Pricing per one</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                product, index
                                            ) in request.Request_prouducts"
                                            :key="product.id"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>
                                                {{
                                                    product.getproduct
                                                        .productname
                                                }}
                                            </td>
                                            <td>{{ product.quantity }}</td>
                                            <td>
                                                {{ product.getproduct.price }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-if="currentuseradmin && !havequtation"
                            @click="showquotationmodal(request)"
                            type="submit"
                            class="btn btn-info"
                        >
                            Send Quotation
                        </button>

                        <button
                            v-if="
                                havequtation &&
                                (currentuseradmin || currentuser)
                            "
                            @click="showQuotation(request)"
                            type="submit"
                            class="btn btn-danger"
                        >
                            view Quotation
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
            id="showQutaion"
            class="modal fade"
            tabindex="1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="showQutaiontitle"
                            style="font-weight: bold"
                        >
                            Quotation Details
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
                    <div v-if="quotationsearch" class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-6 text-left pl-3">
                                <img
                                    src="@/assets/image/Logo.svg"
                                    width="150"
                                />
                            </div>

                            <div class="col-6 text-right pr-3">
                                <h3><strong>Quotation</strong></h3>
                            </div>
                        </div>
                        <div
                            class="row align-items-start justify-content-between m-3 p-2"
                            style="
                                font-size: small;
                                border: solid 1px;
                                border-radius: 5px;
                            "
                        >
                            <div>
                                <p style="margin: 0; padding: 0">
                                    <strong>Quotation by : </strong>
                                    {{ quotationsearch.qutation.getuser.name }}
                                </p>
                                <p>
                                    <strong>Date : </strong>
                                    {{
                                        moment(
                                            quotationsearch.qutation.created_at
                                        ).format("YYYY-MM-DD HH:mm:ss a")
                                    }}
                                </p>
                            </div>
                            <div v-if="request.clientname == null">
                                <p style="margin: 0; padding: 0">
                                    <strong>Quotation to : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getuser.name
                                    }}
                                </p>
                                <p style="margin: 0; padding: 0">
                                    <strong>Phone : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getuser.phone
                                    }}
                                </p>
                                <p style="margin: 0; padding: 0">
                                    <strong>Address : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getuser.Address
                                    }}
                                </p>
                            </div>
                            <div v-if="request.clientname != null">
                                <p style="margin: 0; padding: 0">
                                    <strong>Quotation to : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getclient.name
                                    }}
                                </p>
                                <p style="margin: 0; padding: 0">
                                    <strong>Phone : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getclient.phone
                                    }}
                                </p>
                                <p style="margin: 0; padding: 0">
                                    <strong>Address : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getclient.Address
                                    }}
                                </p>
                            </div>
                            <div>
                                <p style="margin: 0; padding: 0">
                                    <strong>Invoice No : </strong>
                                </p>
                                <p style="margin: 0; padding: 0">
                                    <strong>Invoice Date : </strong>
                                    {{
                                        moment(
                                            quotationsearch.qutation.created_at
                                        ).format("YYYY-MM-DD")
                                    }}
                                </p>
                                <p style="margin: 0; padding: 0">
                                    <strong>Supplier Name : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getsupplier.name
                                    }}
                                </p>
                                <p style="margin: 0; padding: 0">
                                    <strong>Supplier Phone : </strong>
                                    {{
                                        quotationsearch.qutation.getrequest
                                            .getsupplier.phone
                                    }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="row align-items-start justify-content-between m-2 p-2"
                            style="font-size: small"
                        >
                            <table id="example1" class="table">
                                <thead>
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>title</th>
                                        <th>Quantity</th>
                                        <th>Item price</th>
                                        <th>total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="(
                                            product, index
                                        ) in quotationsearch.qutation.getrequest
                                            .product__request"
                                        :key="product.id"
                                    >
                                        <td>{{ index++ }}</td>
                                        <td>
                                            {{ product.getproduct.productname }}
                                        </td>
                                        <td>
                                            {{ product.quantity }}
                                        </td>

                                        <td>
                                            {{ product.getproduct.price }}
                                            <strong>SAR</strong>
                                        </td>

                                        <td>
                                            {{
                                                product.quantity *
                                                product.getproduct.price
                                            }}
                                            <strong>SAR</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            style="font-size: small"
                            class="row justify-content-between align-items-start text-justify m-3"
                        >
                            <div class="col-6">
                                <div>
                                    <h5>
                                        <strong>Terms and Condition</strong>
                                    </h5>
                                    <p>
                                        Please pay within 15 days from the date
                                        pf invoice, overdue interest @14% will
                                        be charged on delayed payments
                                    </p>
                                    <p>
                                        it is a long established fact that a
                                        reader will be distracted by the
                                        readable content of a page when looking
                                        at it is layout. The
                                    </p>
                                </div>
                                <div></div>
                            </div>
                            <div class="col-4">
                                <table id="example1" class="table">
                                    <tbody>
                                        <tr>
                                            <td>SubTotal</td>
                                            <td>
                                                {{
                                                    quotationsearch.totalquottionaprice
                                                }}
                                                <strong>SAR</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tax</td>
                                            <td>
                                                {{
                                                    quotationsearch.qutation
                                                        .Taxes
                                                }}
                                                %
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Delivery</td>
                                            <td>
                                                {{
                                                    quotationsearch.qutation
                                                        .Delivery
                                                }}
                                                SAR
                                            </td>
                                        </tr>
                                        <tr
                                            class="bg-info"
                                            style="
                                                font-size: medium;
                                                padding-bottom: -10%;
                                            "
                                        >
                                            <td>Total Amount</td>
                                            <td>
                                                <p>
                                                    <strong>
                                                        {{
                                                            parseInt(
                                                                quotationsearch.totalquottionaprice +
                                                                    quotationsearch
                                                                        .qutation
                                                                        .Delivery
                                                            ) *
                                                            parseInt(
                                                                quotationsearch
                                                                    .qutation
                                                                    .Taxes
                                                            ) *
                                                            0.01
                                                        }}
                                                        SAR</strong
                                                    >
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="align-items-center m-3">
                            <p
                                class="text-center p-2"
                                style="border: 1px solid; border-radius: 5px"
                            >
                                For any enquiries, email us on
                                <strong>info@hounter.com</strong> or call us
                                <strong>(671) 555-0110</strong>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div
                            v-if="
                                !currentuseradmin &&
                                quotationsearch &&
                                quotationsearch.qutation.statue == 'PENDING'
                            "
                        >
                            <button
                                type="button"
                                class="btn btn-success mr-2"
                                data-dismiss="modal"
                                @click.prevent="
                                    changequotationstatue({
                                        quotationsearch: quotationsearch,
                                        statue: 'ACCEPTED', // or false, depending on your requirements
                                    })
                                "
                            >
                                Accept
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                                @click.prevent="
                                    changequotationstatue({
                                        quotationsearch: quotationsearch,
                                        statue: 'REJECTED', // or false, depending on your requirements
                                    })
                                "
                            >
                                Rejected
                            </button>
                        </div>
                        <p
                            v-if="
                                quotationsearch &&
                                quotationsearch.qutation.statue != 'PENDING'
                            "
                            class="text-success"
                        >
                            {{ quotationsearch.qutation.statue }}
                        </p>
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
                                        v-model="request.Request_prouducts"
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

        <div
            id="Refusecomment"
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
                            Refuse Comment
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
                        <label for="">Please write here refuse comment </label>
                        <textarea
                            v-model="Refuse_Comment.comment"
                            style="background-color: #f2f2f2"
                            class="form-control"
                            rows="5"
                            id="comment"
                        ></textarea>
                        <span v-if="errors && errors.comment">
                            <p class="text text-danger">
                                {{ errors.comment[0] }} *
                            </p>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click.prevent="confirmrefuse"
                            type="submit"
                            class="btn btn-danger"
                        >
                            Send
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
<style scoped>
.modal-body {
    max-height: 450px; /* Adjust the height as needed */
    overflow-y: auto;
}
</style>
<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import moment from "moment";
import { usetoaster } from "../../../../toaster.js";
const format = window.Laravel.format;
const index = 1;
const supplieruser = window.Laravel.user.role == "SUPPLIER";
const currentuser = window.Laravel.user;
const currentuseradmin = window.Laravel.user
    ? window.Laravel.user.role == "ADMIN"
    : "";
const Allproduct = ref([]);
const Quotation = ref({
    Taxes: "",
    Delivery: "",
    request: null,
    user: currentuser.id,
});
const request = ref({
    requestid: "",
    Request_prouducts: [],
    productdescription: "",
    clientname: "",
    getuser: "",
    suppliername: "",
    quantity: "",
    currentuser: currentuser.id,
    client_id: "",
    is_Delivered: "",
    created_at: "",
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
        console.log(allrequest.value);
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
                    toaster.success("statue Changed Successfuly");
                }
            });
    }
};
const is_delivery = (request, statue) => {
    let orderdeliverd = request.is_Delivered;
    axios
        .patch(`/api/request/${request.id}/is_delivered`, {
            statue: orderdeliverd,
        })
        .then((response) => {
            if (response.data.erroor) {
                toaster.error(response.data.erroor);
            } else {
                toaster.success("statue Changed Successfuly");
            }
        });
};
const showquotationmodal = () => {
    Quotation.value.request = request;
    $("#detailsmodal").modal("toggle");
    $("#showQuotation").modal("toggle");
};
const CreateQuotation = () => {
    axios.post("/quotation", Quotation.value).then((response) => {
        $("#showQuotation").modal("toggle");
        toaster.success("Quotation Send Successfully");
        (Quotation.value.Taxes = ""),
            (Quotation.value.Delivery = ""),
            (Quotation.value.request = null),
            (Quotation.value.user = currentuser.id);
    });
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
const Refuse_Comment = ref({ qutation: "", statue: "", comment: "" });

const changequotationstatue = ({ quotationsearch, statue }) => {
    if (statue == "REJECTED") {
        $("#Refusecomment").modal("show");
        Refuse_Comment.value.qutation = quotationsearch;
        Refuse_Comment.value.statue = statue;
    } else {
        axios
            .put(`/quotation/${quotationsearch.qutation.id}`, {
                statue: statue,
            })
            .then((res) => {
                $("#showQutaion").modal("hide");

                toaster.success("statue changed successfully!");
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            });
    }
};
const show_comment = ref(false);

const toggleShowComment = () => {
    show_comment.value = !show_comment.value;
};
const confirmrefuse = () => {
    axios
        .put(
            `/quotation/${Refuse_Comment.value.qutation.qutation.id}`,
            Refuse_Comment.value
        )
        .then((res) => {
            $("#Refusecomment").modal("hide");

            toaster.success("statue changed successfully!");
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
            loading.value = false;
        });
};
const deleterequest = (request) => {
    requestidbeingDelete.value = request.id;
    $("#deleteModal").modal("show");
};
const editrequest = (data) => {
    requestidvalue.value = data.id;
    request.value.Request_prouducts = data.getproduct.id;
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

            $("#deleteModal").modal("hide");
            toaster.success("Request deleted successfully!");
        });
};
const havequtation = ref(false);

const showdetailsmodal = (requestt) => {
    console.log(requestt);
    havequtation.value = false;

    request.value.requestid = requestt.id;

    request.value.Request_prouducts = requestt.product__request;

    request.value.created_at = requestt.created_at;
    request.value.clientname = requestt.getclient;
    request.value.getuser = requestt.getuser;

    axios.get(`/getqutation/${requestt.id}`).then((response) => {
        if (response.data) {
            havequtation.value = true;
        } else {
            havequtation.value = false;
        }
    });
    $("#detailsmodal").modal("show");
};
const quotationsearch = ref();
const qutation = ref(false);
const showQuotation = (request) => {
    axios.get(`/getqutation/${request.requestid}`).then((response) => {
        quotationsearch.value = response.data;
        $("#detailsmodal").modal("hide");

        $("#showQutaion").modal("show");
    });
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
