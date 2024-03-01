<template>
    <section style="position: relative" class="mt-5">
        <div class="shap"></div>
        <div class="container-fluid">
            <div class="sectitle mb-5">
                <div
                    class="d-flex align-items-center gap-2"
                    style="color: #f59e0b"
                >
                    <div
                        style="border-bottom: 2px solid #f59e0b; width: 30px"
                    ></div>
                    Our Recommendation
                </div>
                <div style="margin-left: 35px"><h4>Up Coming Events</h4></div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div v-for="(course, i) in courses" :key="i" class="col">
                    <a :href="course.main_title" style="text-decoration: none">
                        <div class="card" style="margin: auto">
                            <img
                                :src="course.courseImg"
                                class="card-img-top"
                                style="border-radius: 25px !important"
                                alt="..."
                            />
                            <div
                                class="card-body d-flex justify-content-between"
                            >
                                <h5 class="card-title mb-4">
                                    {{ course.coursetitle }}
                                </h5>
                                <p class="card-text text-muted">
                                    {{ course.date }}
                                </p>
                                <!-- <div class="d-flex align-items-center">
                                <div>
                                    <img
                                        style="margin-top: -20px"
                                        class="me-3"
                                        :src="
                                            imageUrl +
                                            '/' +
                                            course.instructorDetails.image
                                        "
                                    />
                                </div>
                                <div class="d-flex flex-column">
                                    <p
                                        style="
                                            font-weight: normal;
                                            line-height: 13px;
                                        "
                                    >
                                        {{
                                            course.instructorDetails
                                                .instructorname
                                        }}
                                    </p>
                                    <p
                                        style="
                                            font-size: 13px;
                                            line-height: 1px;
                                        "
                                    >
                                        {{
                                            course.instructorDetails
                                                .instructortitle
                                        }}
                                    </p>
                                </div>
                            </div> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { ref } from "vue";

export default {
    data() {
        const imageUrl = new URL("../../../assets/image/", import.meta.url);

        var courses = ref([]);
        console.log(courses.value);
        axios.get("/api/apievents").then((response) => {
            // console.log(response.data.data);

            courses.value = response.data.data;
        });
        return { courses, imageUrl };
    },
};
</script>
<style scoped>
.card {
    background-color: transparent;
    border: none;
    width: 18rem;
}
.shap {
    top: 0;
    left: 0;
    position: absolute;
    width: 338px;
    height: 394px;
    transform: rotate(90deg);
    flex-shrink: 0;

    background: #65c5b9;
    opacity: 0.3;
    filter: blur(60px);
}
</style>
