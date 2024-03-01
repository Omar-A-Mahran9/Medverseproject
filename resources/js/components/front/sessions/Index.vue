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
                        <li class="breadcrumb-item active">Session</li>
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
                                    <h5>All Sessions</h5>
                                    <div class="">
                                        <button
                                            v-if="
                                                user.role == 'ADMIN' ||
                                                user.role == 'DOCTOR'
                                            "
                                            class="btn btn-danger"
                                            @click="addnewsession"
                                        >
                                            Add New Session
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
                                                <th>Session Details</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    session, index
                                                ) in allsession"
                                                :key="session.id"
                                            >
                                                <td
                                                    style="
                                                        vertical-align: middle;
                                                    "
                                                >
                                                    {{ index + 1 }}
                                                </td>
                                                <td>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <div>
                                                            <img
                                                                :src="
                                                                    imageUrl +
                                                                    '/' +
                                                                    session.sessionimage
                                                                "
                                                                alt="User Avatar"
                                                                class="img-size-60 img-circle mr-3"
                                                                width="150"
                                                            />
                                                        </div>
                                                        <div>
                                                            <h4>
                                                                <b>{{
                                                                    session.sessionname
                                                                }}</b>
                                                            </h4>
                                                            <p
                                                                v-if="
                                                                    session.sessionuser
                                                                "
                                                                class="text-muted"
                                                                style="
                                                                    margin-top: -10px;
                                                                "
                                                            >
                                                                by
                                                                {{
                                                                    session
                                                                        .sessionuser
                                                                        .name
                                                                }}
                                                            </p>
                                                            <p>
                                                                {{
                                                                    session.sessiontype
                                                                }}
                                                                Session
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td
                                                    style="
                                                        vertical-align: middle;
                                                    "
                                                >
                                                    <a
                                                        v-if="
                                                            user.role !=
                                                                'ADMIN' &&
                                                            user.Package_id !=
                                                                3 &&
                                                            user.role !=
                                                                'ADMIN' &&
                                                            user.Package_id != 1
                                                        "
                                                        class="btn btn-success"
                                                        @click="
                                                            book(session.id)
                                                        "
                                                        style="
                                                            color: #ffffff;

                                                            border-radius: 20px;
                                                        "
                                                        >Book Now</a
                                                    >
                                                    <!-- <a
                                                        v-if="
                                                            user.role ===
                                                            'ADMIN'
                                                        "
                                                        class="mr-4"
                                                        href="#"
                                                        @click="
                                                            editsession(session)
                                                        "
                                                        ><i
                                                            class="fas fa-pen text-white bg-primary rounded p-1"
                                                        ></i
                                                    ></a> -->
                                                    <a
                                                        v-if="
                                                            user.role == 'ADMIN'
                                                        "
                                                        href="#"
                                                        @click="
                                                            deletesession(
                                                                session
                                                            )
                                                        "
                                                        ><i
                                                            class="fas fa-trash text-danger"
                                                        ></i
                                                    ></a>
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
    <div id="addsessionmodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new Session</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="addsession">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="eventname">Session name</label>
                                <p
                                    v-if="errors && errors.sessionname"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionname[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="session.sessionname"
                                    name="sessionname"
                                    id="sessionname"
                                    placeholder="Enter Session name"
                                />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productid">Session type</label>
                                <p
                                    v-if="errors && errors.sessiontype"
                                    class="text text-danger"
                                >
                                    {{ errors.sessiontype[0] }}*
                                </p>
                                <select
                                    name="sessiontype"
                                    v-model="session.sessiontype"
                                    class="form-control"
                                >
                                    <option hidden selected value="">
                                        choose session type
                                    </option>
                                    <option
                                        v-for="session in sessiontype"
                                        :value="session.value"
                                    >
                                        {{ session.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sessionlink">Session link</label>
                                <p
                                    v-if="errors && errors.sessionlink"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionlink[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="session.sessionlink"
                                    name="sessionlink"
                                    id="sessionlink"
                                    placeholder="Enter Session link"
                                />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sessionlink">Session Price</label>
                                <p
                                    v-if="errors && errors.sessionprice"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionprice[0] }}*
                                </p>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="session.sessionprice"
                                    name="sessionprice"
                                    id="sessionprice"
                                    placeholder="Enter Session price $$"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile"
                                    >Session image</label
                                >
                                <p
                                    v-if="errors && errors.sessionimage"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionimage[0] }}*
                                </p>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                            name="session_image"
                                            @change="handleimage"
                                        />
                                        <label
                                            v-if="session.sessionimage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >{{
                                                session.sessionimage.name
                                            }}</label
                                        >
                                        <label
                                            v-if="!session.sessionimage"
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
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="eventname">Session Date</label>
                                <p
                                    v-if="errors && errors.sessioncalender"
                                    class="text text-danger"
                                >
                                    {{ errors.sessioncalender[0] }}*
                                </p>

                                <div class="d-flex">
                                    <input
                                        type="date"
                                        class="form-control mr-2"
                                        v-model="calender"
                                        name="sessioncalender"
                                        id="sessioncalender"
                                        placeholder="Enter Session date"
                                    />
                                    <div
                                        class="btn btn-success mr-4"
                                        @click="adddate"
                                    >
                                        +
                                    </div>
                                </div>
                            </div>
                            <table
                                class="col-md-6 table table-bordered table-striped mt-4"
                            >
                                <tbody>
                                    <tr>
                                        <th>Day</th>
                                        <th>available time</th>
                                    </tr>
                                    <tr
                                        v-for="(
                                            date, index
                                        ) in session.sessioncalender"
                                    >
                                        <td class="text-center">
                                            <div
                                                class="d-flex align-items-center justify-content-center"
                                            >
                                                <p>
                                                    {{ date }}
                                                </p>
                                                <a
                                                    @click.prevent="
                                                        deletedate(index)
                                                    "
                                                    class="fas fa-trash text-danger mb-3 ml-5"
                                                ></a>
                                            </div>
                                            <p
                                                v-if="
                                                    errors &&
                                                    errors.sessiontimes
                                                "
                                                class="text text-danger"
                                            >
                                                {{ errors.sessiontimes[0] }}*
                                            </p>
                                            <input
                                                class="form-control"
                                                type="time"
                                                v-model="time"
                                                @change="timeofcalender(index)"
                                            />
                                        </td>

                                        <div
                                            v-for="(
                                                sessiontime, timeindex
                                            ) in session.sessiontimes"
                                        >
                                            <div
                                                v-if="
                                                    sessiontime.calenderid ==
                                                    index
                                                "
                                                class="d-flex align-items-center justify-content-center"
                                            >
                                                <p>
                                                    {{ sessiontime.timee }}
                                                    {{ amOrPm }}
                                                </p>
                                                <a
                                                    @click.prevent="
                                                        deletetime(timeindex)
                                                    "
                                                    class="fas fa-trash text-danger mb-3 ml-5"
                                                ></a>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- <div class="form-group col-md-4">
                                <label for="productid">Session type</label>
                                <p
                                    v-if="errors && errors.sessiontype"
                                    class="text text-danger"
                                >
                                    {{ errors.sessiontype }}*
                                </p>
                                <select
                                    name="sessiontype"
                                    v-model="session.sessiontype"
                                    class="form-control"
                                >
                                    <option hidden selected value="">
                                        choose session type
                                    </option>
                                    <option
                                        v-for="session in sessiontype"
                                        :value="session.value"
                                    >
                                        {{ session.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sessionlink">Session link</label>
                                <p
                                    v-if="errors && errors.sessionlink"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionlink[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="session.sessionlink"
                                    name="sessionlink"
                                    id="sessionlink"
                                    placeholder="Enter Session link"
                                />
                            </div> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Add Session
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
    <div id="editsessionmodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Session</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editsessionnow">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="eventname">Session name</label>
                                <p
                                    v-if="errors && errors.sessionname"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionname[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="session.sessionname"
                                    name="sessionname"
                                    id="sessionname"
                                    placeholder="Enter Session name"
                                />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productid">Session type</label>
                                <p
                                    v-if="errors && errors.sessiontype"
                                    class="text text-danger"
                                >
                                    {{ errors.sessiontype[0] }}*
                                </p>
                                <select
                                    name="sessiontype"
                                    v-model="session.sessiontype"
                                    class="form-control"
                                >
                                    <option hidden selected value="">
                                        choose session type
                                    </option>
                                    <option
                                        v-for="session in sessiontype"
                                        :value="session.value"
                                    >
                                        {{ session.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sessionlink">Session link</label>
                                <p
                                    v-if="errors && errors.sessionlink"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionlink[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="session.sessionlink"
                                    name="sessionlink"
                                    id="sessionlink"
                                    placeholder="Enter Session link"
                                />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sessionlink">Session Price</label>
                                <p
                                    v-if="errors && errors.sessionprice"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionprice[0] }}*
                                </p>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="session.sessionprice"
                                    name="sessionprice"
                                    id="sessionprice"
                                    placeholder="Enter Session price $$"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile"
                                    >Session image</label
                                >
                                <p
                                    v-if="errors && errors.sessionimage"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionimage[0] }}*
                                </p>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                            name="session_image"
                                            @change="handleimage"
                                        />
                                        <label
                                            v-if="session.sessionimage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >{{
                                                session.sessionimage.name
                                            }}</label
                                        >
                                        <label
                                            v-if="!session.sessionimage"
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
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="eventname">Session Date</label>
                                <p
                                    v-if="errors && errors.sessioncalender"
                                    class="text text-danger"
                                >
                                    {{ errors.sessioncalender[0] }}*
                                </p>
                                <div class="d-flex">
                                    <input
                                        type="date"
                                        class="form-control mr-2"
                                        v-model="calender"
                                        name="sessioncalender"
                                        id="sessioncalender"
                                        placeholder="Enter Session date"
                                    />
                                    <div
                                        class="btn btn-success mr-4"
                                        @click="adddate"
                                    >
                                        +
                                    </div>
                                </div>
                            </div>
                            <table
                                class="col-md-6 table table-bordered table-striped mt-4"
                            >
                                <tbody>
                                    <tr>
                                        <th>Day</th>
                                        <th>available time</th>
                                    </tr>
                                    <tr
                                        v-for="(
                                            date, index
                                        ) in session.sessioncalender"
                                    >
                                        <td class="text-center">
                                            <div
                                                class="d-flex align-items-center justify-content-center"
                                            >
                                                <p>
                                                    {{ date.sessioncalender }}
                                                </p>
                                                <a
                                                    @click.prevent="
                                                        deletedate(index)
                                                    "
                                                    class="fas fa-trash text-danger mb-3 ml-5"
                                                ></a>
                                            </div>
                                            <p
                                                v-if="
                                                    errors &&
                                                    errors.sessiontimes
                                                "
                                                class="text text-danger"
                                            >
                                                {{ errors.sessiontimes[0] }}*
                                            </p>
                                            <input
                                                class="form-control"
                                                type="time"
                                                v-model="time"
                                                @change="timeofcalender(index)"
                                            />
                                        </td>
                                        <div
                                            v-for="(
                                                sessiontime, timeindex
                                            ) in session.sessiontimes"
                                        >
                                            <div
                                                v-if="
                                                    sessiontime.sessioncalender_id ==
                                                    date.id
                                                "
                                                class="d-flex align-items-center justify-content-center"
                                            >
                                                <p>
                                                    {{
                                                        sessiontime.sessiontime
                                                    }}
                                                </p>
                                                <a
                                                    @click.prevent="
                                                        deletetime(timeindex)
                                                    "
                                                    class="fas fa-trash text-danger mb-3 ml-5"
                                                ></a>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Update Session
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
    <div id="bookmodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Booking</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="Booknow">
                    <div class="modal-body">
                        <p class="text-danger" v-if="errorrr">{{ errorrr }}</p>
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-4">
                                <label for="eventname">Session name</label>
                                <p
                                    v-if="errors && errors.sessionname"
                                    class="text text-danger"
                                >
                                    {{ errors.sessionname[0] }}*
                                </p>

                                <input
                                    disabled
                                    type="text"
                                    class="form-control"
                                    v-model="session.sessionname"
                                    name="sessionname"
                                    id="sessionname"
                                    placeholder="Enter Session name"
                                />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productid">Session type</label>
                                <p
                                    v-if="errors && errors.sessiontype"
                                    class="text text-danger"
                                >
                                    {{ errors.sessiontype[0] }}*
                                </p>

                                <select
                                    disabled
                                    name="sessiontype"
                                    v-model="session.sessiontype"
                                    class="form-control"
                                >
                                    <option hidden selected value="">
                                        choose session type
                                    </option>
                                    <option>
                                        {{ session.sessiontype }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productid"
                                    >Choose Date of Session</label
                                >
                                <p
                                    v-if="errors && errors.date"
                                    class="text text-danger"
                                >
                                    {{ errors.date[0] }}*
                                </p>

                                <select
                                    name="sessiondate"
                                    v-model="booking.date"
                                    class="form-control"
                                    @change="changetimetodate(booking.date)"
                                >
                                    <option hidden selected value="">
                                        choose session date
                                    </option>
                                    <option
                                        v-for="session in session.sessioncalender"
                                        :value="session.id"
                                    >
                                        {{ session.sessioncalender }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="productid"
                                    >Choose Time of Session</label
                                >
                                <p
                                    v-if="errors && errors.time"
                                    class="text text-danger"
                                >
                                    {{ errors.time[0] }}*
                                </p>

                                <select
                                    name="sessiontime"
                                    v-model="booking.time"
                                    class="form-control"
                                    @change="changetimetodate(booking.date)"
                                >
                                    <option hidden selected value="">
                                        choose session time
                                    </option>
                                    <option
                                        v-for="session in session.sessiontimes"
                                        :value="session.id"
                                    >
                                        {{ session.sessiontime }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-7 ml-5 text-right">
                                <span>price</span>
                                <h3 class="text-success">
                                    {{ session.sessionprice }}$
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Booking Now
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
                        Delete Session
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
                        Are you sure you want to delete this Session?
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
    <div id="paymodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Methods</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="">
                            <div class="card-header">
                                <div
                                    class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2"
                                >
                                    <!-- Credit card form tabs -->
                                    <ul
                                        role="tablist"
                                        class="nav bg-light nav-pills rounded nav-fill mb-3"
                                    >
                                        <li class="nav-item">
                                            <a
                                                data-toggle="pill"
                                                href="#credit-card"
                                                class="nav-link active"
                                            >
                                                <i
                                                    class="fas fa-credit-card mr-2"
                                                ></i>
                                                Credit Card
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                data-toggle="pill"
                                                href="#paypal"
                                                class="nav-link"
                                            >
                                                <i
                                                    class="fab fa-paypal mr-2"
                                                ></i>
                                                Paypal
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                data-toggle="pill"
                                                href="#net-banking"
                                                class="nav-link"
                                            >
                                                <i
                                                    class="fas fa-mobile-alt mr-2"
                                                ></i>
                                                Net Banking
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End -->
                                <!-- Credit card form content -->
                                <div class="tab-content">
                                    <!-- credit card info-->
                                    <div
                                        id="credit-card"
                                        class="tab-pane fade show active pt-3"
                                    >
                                        <form role="form">
                                            <div class="form-group">
                                                <label for="username">
                                                    <h6>Card Owner</h6>
                                                </label>
                                                <input
                                                    type="text"
                                                    name="username"
                                                    placeholder="Card Owner Name"
                                                    required
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <label for="cardNumber">
                                                    <h6>Card number</h6>
                                                </label>

                                                <div class="input-group">
                                                    <input
                                                        type="text"
                                                        name="cardNumber"
                                                        placeholder="Valid card number"
                                                        class="form-control"
                                                        required
                                                    />
                                                    <div
                                                        class="input-group-append"
                                                    >
                                                        <span
                                                            class="input-group-text"
                                                        >
                                                            <img
                                                                src="../../../assets/image/visa.png"
                                                                alt=""
                                                                width="25"
                                                            />
                                                            <img
                                                                src="../../../assets/image/mada.svg"
                                                                alt=""
                                                                width="25"
                                                            />
                                                            <img
                                                                src="../../../assets/image/master.svg"
                                                                alt=""
                                                                width="25"
                                                            />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>
                                                            <span
                                                                class="hidden-xs"
                                                            >
                                                                <h6>
                                                                    Expiration
                                                                    Date
                                                                </h6>
                                                            </span>
                                                        </label>
                                                        <div
                                                            class="input-group"
                                                        >
                                                            <input
                                                                type="number"
                                                                placeholder="MM"
                                                                name=""
                                                                class="form-control"
                                                                required
                                                            />
                                                            <input
                                                                type="number"
                                                                placeholder="YY"
                                                                name=""
                                                                class="form-control"
                                                                required
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div
                                                        class="form-group mb-4"
                                                    >
                                                        <label
                                                            data-toggle="tooltip"
                                                            title="Three digit CV code on the back of your card"
                                                        >
                                                            <h6>
                                                                CVV
                                                                <i
                                                                    class="fa fa-question-circle d-inline"
                                                                ></i>
                                                            </h6>
                                                        </label>
                                                        <input
                                                            type="text"
                                                            required
                                                            class="form-control"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button
                                                    @click="
                                                        confirmappointment()
                                                    "
                                                    type="button"
                                                    class="subscribe btn btn-danger btn-block shadow-sm"
                                                >
                                                    Confirm Payment
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End -->
                                    <!-- Paypal info -->
                                    <div id="paypal" class="tab-pane fade pt-3">
                                        <h6 class="pb-2">
                                            Select your paypal account type
                                        </h6>
                                        <div class="form-group">
                                            <label class="radio-inline">
                                                <input
                                                    type="radio"
                                                    name="optradio"
                                                    checked
                                                />
                                                Domestic
                                            </label>
                                            <label class="radio-inline">
                                                <input
                                                    type="radio"
                                                    name="optradio"
                                                    class="ml-5"
                                                />International
                                            </label>
                                        </div>
                                        <p>
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                            >
                                                <i
                                                    class="fab fa-paypal mr-2"
                                                ></i>
                                                Log into my Paypal
                                            </button>
                                        </p>
                                        <p class="text-muted">
                                            Note: After clicking on the button,
                                            you will be directed to a secure
                                            gateway for payment. After
                                            completing the payment process, you
                                            will be redirected back to the
                                            website to view details of your
                                            order.
                                        </p>
                                    </div>
                                    <!-- End -->
                                    <!-- bank transfer info -->
                                    <div
                                        id="net-banking"
                                        class="tab-pane fade pt-3"
                                    >
                                        <div class="form-group">
                                            <label for="Select Your Bank">
                                                <h6>Select your Bank</h6>
                                            </label>
                                            <select
                                                class="form-control"
                                                id="ccmonth"
                                            >
                                                <option
                                                    value=""
                                                    selected
                                                    disabled
                                                >
                                                    --Please select your Bank--
                                                </option>
                                                <option>Bank 1</option>
                                                <option>Bank 2</option>
                                                <option>Bank 3</option>
                                                <option>Bank 4</option>
                                                <option>Bank 5</option>
                                                <option>Bank 6</option>
                                                <option>Bank 7</option>
                                                <option>Bank 8</option>
                                                <option>Bank 9</option>
                                                <option>Bank 10</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                >
                                                    <i
                                                        class="fas fa-mobile-alt mr-2"
                                                    ></i>
                                                    Proceed Payment
                                                </button>
                                            </p>
                                        </div>
                                        <p class="text-muted">
                                            Note: After clicking on the button,
                                            you will be directed to a secure
                                            gateway for payment. After
                                            completing the payment process, you
                                            will be redirected back to the
                                            website to view details of your
                                            order.
                                        </p>
                                    </div>
                                    <!-- End -->
                                    <!-- End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted, reactive, ref } from "vue";
import { usetoaster } from "../../../toaster.js";
import axios from "axios";
import moment from "moment";

const calender = ref();
const time = ref();
const convertedTime = ref("");
const amOrPm = ref();
const update = ref(false);
const format = window.Laravel.format;
const user = window.Laravel.user;
const errors = ref(null);
const sessionidbeingedit = ref();
const sessionidbeingDelete = ref();
const toaster = usetoaster();
const allsession = ref([]);
const sessiontype = ref([
    {
        name: "Online",
        value: "Online",
    },
    {
        name: "Offline",
        value: "Offline",
    },
    {
        name: "Others",
        value: "Others",
    },
]);
const calendar = ref([]);
const timecal = ref([]);

const session = ref({
    session_id: null,
    sessionname: "",
    sessionimage: "",
    sessionlink: "",
    sessiontype: "",
    sessionprice: "",
    sessioncalender: null,
    sessiontimes: [],
});
const imageUrl = new URL("../../../../../storage", import.meta.url);

const deletesession = (session) => {
    sessionidbeingDelete.value = session.id;
    $("#deleteModal").modal("show");
};
session.value.sessioncalender = [];
const adddate = () => {
    if (calender.value == null || calender.value == "") {
        alert("sorry must be fill date firstly");
    } else {
        session.value.sessioncalender.push(calender.value);
    }
};
const timeofcalender = (data) => {
    const timeParts = time.value.split(":");
    const hour = parseInt(timeParts[0]);
    const minutes = parseInt(timeParts[1]);
    let convertedHour = hour;
    if (hour >= 12) {
        convertedHour -= 12;
    } else if (hour === 0) {
        convertedHour = 12;
    }

    const amOrPm = hour >= 12 ? "PM" : "AM";

    convertedTime.value = `${convertedHour}:${minutes} ${amOrPm}`;

    session.value.sessiontimes.push({
        calenderid: data,
        timee: convertedTime.value,
    });
    time.value = "";
};

const handleimage = (e) => {
    const file = e.target.files[0];
    session.value.sessionimage = file;
};

const confirmdelete = () => {
    axios
        .delete(`/api/session/delete/${sessionidbeingDelete.value}`)
        .then((response) => {
            allsession.value = allsession.value.filter(
                (session) => session.id !== sessionidbeingDelete.value
            );
            $("#deleteModal").modal("hide");
            toaster.success("Session delete successfully!");
        });
};
const addnewsession = () => {
    session.value.sessionname = "";
    session.value.sessionimage = null;
    session.value.sessionlink = "";
    session.value.sessioncalender = [];
    session.value.sessiontimes = [];
    session.value.sessiontype = "";
    session.value.sessionprice = "";

    $("#addsessionmodal").modal("show");
};
const allsessions = () => {
    axios.get("/api/session").then((response) => {
        allsession.value = response.data;
    });
};

const addsession = () => {
    update.value = false;
    if (user.role == "ADMIN" || user.role == "DOCTOR") {
        const formData = new FormData();
        formData.append("sessionname", session.value.sessionname);
        formData.append("sessiontype", session.value.sessiontype);
        formData.append("sessionimage", session.value.sessionimage);
        formData.append("sessionlink", session.value.sessionlink);
        formData.append("sessionprice", session.value.sessionprice);
        session.value.sessioncalender.forEach((item) => {
            formData.append("sessioncalender[]", item);
        });
        session.value.sessiontimes.forEach((item) => {
            formData.append("sessiontimes[]", JSON.stringify(item));
        });
        axios
            .post("/addsession", formData)
            .then((response) => {
                allsession.value.unshift(response.data);
                toaster.success("Session Added Successfully");
                $("#addsessionmodal").modal("hide");
                session.value.sessionname = "";
                session.value.sessionimage = null;
                session.value.sessionlink = "";
                session.value.sessioncalender = [];
                session.value.sessiontimes = [];
                session.value.sessiontype = "";
                errors.value = null;
            })
            .catch((error) => {
                errors.value = error.response.data.errors;
                loading.value = false;
            });
    }
};
const deletetime = (timeindex) => {
    session.value.sessiontimes = session.value.sessiontimes.filter(
        (sessiontime) => {
            const index = session.value.sessiontimes.findIndex(
                (item) => item === sessiontime
            );
            return index !== timeindex;
        }
    );
};

const editsession = (sessionn) => {
    axios.get(`/api/calendar/${sessionn.id}`).then((response) => {
        calendar.value = response.data;
        session.value.sessioncalender = [];
        session.value.sessiontimes = [];
        session.value.session_id = sessionn.id;
        calendar.value.forEach((element) => {
            session.value.sessioncalender.push(element);
            axios.get(`/api/time/${element.id}`).then((response) => {
                timecal.value = response.data;
                timecal.value.forEach((element) => {
                    session.value.sessiontimes.push(element);
                });
            });
        });
    });

    update.value = true;
    session.value.sessionname = sessionn.sessionname;
    session.value.sessionlink = sessionn.sessionlink;
    if (sessionn.sessionimage != null) {
        session.value.sessionimage = sessionn.sessionimage;
    }
    session.value.sessiontype = sessionn.sessiontype;
    session.value.sessionprice = sessionn.sessionprice;

    $("#editsessionmodal").modal("show");
};

const editsessionnow = () => {
    update.value = false;
    if (user.role == "ADMIN" || user.role == "DOCTOR") {
        const formData = new FormData();
        formData.append("session_id", session.value.session_id);
        formData.append("sessionname", session.value.sessionname);
        formData.append("sessiontype", session.value.sessiontype);
        formData.append("sessionimage", session.value.sessionimage);
        formData.append("sessionlink", session.value.sessionlink);
        formData.append("sessionprice", session.value.sessionprice);
        session.value.sessioncalender.forEach((item) => {
            formData.append(
                "sessioncalender[]",
                JSON.stringify(item.sessioncalender)
            );
        });
        session.value.sessiontimes.forEach((item) => {
            formData.append("sessiontimes[]", JSON.stringify(item));
        });
        axios
            .post("/updatesession", formData)
            .then((response) => {
                allsession.value.unshift(response.data);
                toaster.success("Session Updated Successfully");
                $("#editsessionmodal").modal("hide");
                session.value.sessionname = "";
                session.value.sessionimage = null;
                session.value.sessionlink = "";
                session.value.sessioncalender = [];
                session.value.sessiontimes = [];
                session.value.sessiontype = "";
                errors.value = null;
            })
            .catch((error) => {
                errors.value = error.response.data.errors;
                loading.value = false;
            });
    }
};
const deletedate = (datid) => {
    session.value.sessioncalender = session.value.sessioncalender.filter(
        (sessioncalende) => {
            const index = session.value.sessioncalender.findIndex(
                (item) => item === sessioncalende
            );
            session.value.sessiontimes = session.value.sessiontimes.filter(
                (sessiontime) => {
                    return sessiontime.calenderid !== index;
                }
            );
            return index !== datid;
        }
    );
};
const sessionidbooking = ref();
const booking = ref({
    session_name: "",
    session_type: "",
    date: "",
    time: "",
    statue: "UNPAID",
    client_id: user.id,
});
const book = (id) => {
    booking.value.session_name = "";
    booking.value.session_type = "";
    booking.value.date = "";
    booking.value.time = "";

    sessionidbooking.value = id;
    axios.get(`/api/session/${id}`).then((response) => {
        session.value = response.data;
        booking.value.session_name = session.value.id;
        booking.value.session_type = session.value.sessiontype;
        $("#bookmodal").modal("show");
    });
};
const changetimetodate = (id) => {
    axios.get(`/api/gettime/${id}`).then((response) => {
        session.value.sessiontimes = response.data;
    });
};
const errorrr = ref(null);
const Booknow = () => {
    if (booking.value.date == "" || booking.value.time == "") {
        errorrr.value = "Must be fill date and time firstly please";
        return errorrr.value;
    } else {
        $("#paymodal").modal("show");
    }
};
const confirmappointment = () => {
    booking.value.statue = "PAID";
    if (booking.value.statue == "PAID") {
        axios.post("/api/appointment", booking.value).then(() => {
            $("#paymodal").modal("hide");
            $("#bookmodal").modal("hide");
            toaster.success("Your Appointment accepted!");
            console.log(response.data);
        });
    }
};

const getalltime = (calendarid) => {
    axios.get(`api/time/${calendarid}`).then(() => {});
};
onMounted(() => {
    allsessions();
});
</script>
