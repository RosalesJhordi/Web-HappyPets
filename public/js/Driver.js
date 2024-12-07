const driver = window.driver.js.driver;

const driverObj = driver({
  showProgress: true,
  steps: [
    { element: '.login', popover: { title: 'Registro y Autenticación', description: 'En esta sección puedes registrarse o crear una cuenta' } },
    { element: '.notification', popover: { title: 'Title', description: 'Description' } },
    { element: '.carrito', popover: { title: 'Title', description: 'Description' } },
    { element: '.footer', popover: { title: 'Title', description: 'Description' } },
  ]
});

driverObj.drive();
