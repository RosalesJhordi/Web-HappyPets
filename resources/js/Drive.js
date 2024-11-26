import { driver } from "driver.js";
import "driver.js/dist/driver.css";


const driverObj = driver({
    showButtons: ["next", "previous", "close"],
    steps: [
        {
            element: "#login",
            popover: {
                title: "Registro y Autenticación",
                description:
                    "En esta sección puedes registrarse o crear una cuenta",
                position: "bottom",
            },
        },
        {
            element: "#notification",
            popover: {
                title: "Notificaciones",
                description: "En esta sección se le mostrara notificaciones ",
            },
        },
        {
            element: "#carrito",
            popover: {
                title: "Carrito de Compras",
                description:
                    "En esta sección se le mostrara los productsos que añada a su carrito de compras ",
            },
        },
    ],
});

driverObj.drive();
