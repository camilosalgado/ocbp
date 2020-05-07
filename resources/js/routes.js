import DashBoard from "./components/Dashboard/DashBoard";
import UserRegister from "./components/Users/UserRegister";
import Farmacia from "./components/Farmacia/Farmacia";
import Medicamentos from "./components/Medicamentos/Medicamentos";
import Business from "./components/Business/Business";
import NotFound from "./components/NotFound/NotFound";
import Laboratorios from "./components/Laboratorios/Laboratorios";
import Ordenes from "./components/OrdenesCompra/Ordenes";
import AsociacionHovital from "./components/Farmacia/Pages/AsociacionHovital";
import AprobacionParaCompra from "./components/Farmacia/Pages/AprobacionParaCompra";

export const routes = [
    {
      name: 'home',
      path: '/home',
      component: Medicamentos,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "register",
        path: "/register",
        component: UserRegister,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "asociarmedicamento",
        path: "/asociarmedicamento",
        component: AsociacionHovital,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "aprobaciones",
        path: "/aprobaciones",
        component: AprobacionParaCompra,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "farmacia",
        path: "/farmacia",
        component: Farmacia,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: DashBoard,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "medicamentos",
        path: "/business",
        component: Medicamentos,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "ordenescompra",
        path: "/ordenescompra",
        component: Ordenes,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "laboratorios",
        path: "/laboratorios",
        component: Laboratorios,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: "business",
        path: "/medicamentos",
        component: Business,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: '404',
        path: "/404",
        component: NotFound
    },
    {
        path: "*",
        component: require('./components/NotFound/NotFound').default,
    },
];

