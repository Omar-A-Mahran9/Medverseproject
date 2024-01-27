import HomeView from "@/components/front/home/index.vue";
import Dashboard from "@/components/Dashboard/content/dashboard/Dashboard.vue";
import MainDashboard from "@/components/Dashboard/content/dashboard/Main.vue";
import Eventss from "@/components/front/events/Index.vue";
import sessions from "@/components/front/sessions/Index.vue";
import appointments from "@/components/front/Appointment/Index.vue";
import inventory from "@/components/Dashboard/content/inventory/Inventory.vue";
import customerervice from "@/components/Dashboard/content/customerservice/Customerervice.vue";
import reports from "@/components/Dashboard/content/reports/reports.vue";
import newrequest from "@/components/Dashboard/content/newrequest/Newrequest.vue";
import myrequest from "@/components/Dashboard/content/myrequest/Myrequest.vue";
import orders from "@/components/Dashboard/content/orders/Index.vue";
import comments from "@/components/Dashboard/content/comments/Index.vue";
import clinicinventory from "@/components/Dashboard/content/clinicinventory/index.vue";
import users from "@/components/Dashboard/content/users/Users.vue";
import profile from "@/components/Dashboard/content/profile/profile.vue";
import setting from "@/components/Dashboard/content/settingsite/Index.vue";
import login from "@/components/auth/Login.vue";
import SignupViewVue from "@/components/auth/SignupView.vue";
import AcadmicView from "@/components/front/academic/Index.vue";
import InventoryView from "@/components/front/Inventory/InventoryIndex.vue";
import profilefront from "@/components/front/Profile/IndexComp.vue";
import consultant from "@/components/front/consltant/Index.vue";

export default [
    {
        path: "/admin/event",
        name: "admin.events",
        component: Eventss,
    },
    {
        path: "/admin/session",
        name: "admin.sessions",
        component: sessions,
    },
    {
        path: "/admin/appointment",
        name: "admin.appointment",
        component: appointments,
    },
    {
        path: "/admin",
        name: "admin",
        component: MainDashboard,
    },
    {
        path: "/admin/dashboard",
        name: "admin.dashboard",
        component: Dashboard,
    },
    {
        path: "/academic",
        name: "academic",
        component: AcadmicView,
    },
    {
        path: "/consultant",
        name: "consultant",
        component: consultant,
    },
    {
        path: "/inventory",
        name: "inventory",
        component: InventoryView,
    },
    {
        path: "/",
        name: "home",
        component: HomeView,
    },
    {
        path: "/register",
        name: "Signup",
        component: SignupViewVue,
    },
    {
        path: "/admin/users",
        name: "admin.users",
        component: users,
    },
    {
        path: "/admin/profile",
        name: "admin.profile",
        component: profile,
    },
    {
        path: "/admin/inventory",
        name: "admin.inventory",
        component: inventory,
    },
    {
        path: "/admin/inventory/:clinic_id",
        name: "admin.inventoryclinic",
        component: clinicinventory,
        props: true,
    },
    {
        path: "/admin/customerervice",
        name: "admin.customerervice",
        component: customerervice,
    },
    {
        path: "/admin/reports",
        name: "admin.reports",
        component: reports,
    },
    {
        path: "/admin/newrequest",
        name: "admin.newrequest",
        component: newrequest,
    },
    {
        path: "/admin/myrequest",
        name: "admin.myrequest",
        component: myrequest,
    },
    {
        path: "/admin/setting",
        name: "admin.setting",
        component: setting,
    },
    {
        path: "/login",
        name: "login",
        component: login,
    },
    {
        path: "/admin/orders",
        name: "admin.orders",
        component: orders,
    },
    {
        path: "/admin/comments",
        name: "admin.comments",
        component: comments,
    },
    {
        path: "/profile",
        name: "profile",
        component: profilefront,
    },
];
