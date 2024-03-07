#Jefferson , Joaquín , Álvaro
DROP DATABASE IF EXISTS tiffosi;

-- Crear la base de datos tiffosi
CREATE DATABASE tiffosi;

-- Usar la base de datos tiffosi
USE tiffosi;

-- Crear la tabla de pizzas
CREATE TABLE IF NOT EXISTS pizzas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock int(10) NOT NULL,
    stockminimo int(10) NOT NULL,
    descripcion VARCHAR(2000) NOT NULL,
    foto VARCHAR(100) NOT NULL
);

-- Crear la tabla de personas
CREATE TABLE IF NOT EXISTS personas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    rol varchar(20) NOT NULL,
    contraseña VARCHAR(100) NOT NULL,
    correo VARCHAR(100),
    direccion VARCHAR(100)
);


-- Crear la tabla de factura
CREATE TABLE IF NOT EXISTS factura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente INT NOT NULL,
    pizza INT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (cliente) REFERENCES personas(id),
    FOREIGN KEY (pizza) REFERENCES pizzas(id)
);


-- Crear la tabla de carrito
DROP TABLE if EXISTS carrito;
CREATE TABle carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    foto VARCHAR(100) NOT NULL,
    id_user INT NOT NULL,
    cant INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES personas(id)
);

INSERT INTO pizzas (id, nombre, precio, stock, stockminimo, descripcion, foto) VALUES
(1,'Margarita',12.99,50,10,'La pizza Margarita es una de las pizzas más clásicas y reconocibles en todo el mundo. Originaria de Italia, su nombre se atribuye a la reina Margarita de Saboya, quien supuestamente la probó en el siglo XIX y quedó encantada con sus sabores simples pero deliciosos.','margarita.png'),
(2,'Cuatro Quesos',15.99,40,8,'La pizza cuatro quesos es una deliciosa variante de la clásica pizza italiana que destaca por su generosa cantidad de quesos derretidos sobre una base de masa crujiente. Como su nombre indica, esta pizza está cargada con cuatro tipos diferentes de queso, que se combinan para crear una experiencia rica y sabrosa.','quesos.png'),
(3,'Napolitana',14.99,30,7,'La pizza napolitana es una variedad clásica de pizza originaria de Nápoles, Italia, y es reconocida por su masa delgada y bordes ligeramente inflados y chamuscados. Esta pizza se caracteriza por su sencillez y frescura de ingredientes.','napolitana.png'),
(4,'Carbonara',13.99,35,5, 'La pizza carbonara es una variante de pizza inspirada en la famosa pasta carbonara, que combina ingredientes como huevo, panceta (o bacon), queso parmesano y pimienta negra. Aunque no es tan tradicional como otros tipos de pizza, la pizza carbonara ha ganado popularidad por su delicioso sabor y su fusión de ingredientes característicos de la cocina italiana.','carbonara.png'),
(5, 'Hawaiana', 14.49, 45, 10, 'La pizza hawaiana es una combinación deliciosa de sabores dulces y salados. Está cubierta con salsa de tomate, trozos de jamón, piña y queso mozzarella. Es una opción popular para aquellos que disfrutan de una experiencia de pizza tropical.', 'hawaiana.png'),
(6, 'Vegetariana', 13.99, 35, 8, 'La pizza vegetariana es perfecta para los amantes de las verduras. Está cubierta con una variedad de vegetales frescos, como pimientos, cebollas, champiñones, aceitunas y tomates, sobre una base de salsa de tomate y queso mozzarella.', 'vegetariana.png');

INSERT INTO personas (id, nombre, rol, contraseña, correo, direccion) VALUES 
(1,'alvaro','administrador','alvaro','alvaro.parra3@educa.madrid.org','Av. de Entrevías, 146'), 
(2,'María','cliente','maria','maria@gmail.com','Rda. del Sur, 217'), 
(3,'joaquin','administrador','joaquin','joaquin.campsmartinez@educa.madrid.org','Santa Eugenia'), 
(4,'Ana','cliente','ana','ana@gmail.com','Calle del Dr. Rivas, 36'), 
(5,'jeffer','administrador','******','noe.chavarry@educa.madrid.org','Rda. del Sur, 195'), 
(6,'juan','empleado','juan','juan@gmail.com','Calle Benamejí, 154'),
(7,'cliente','cliente','cliente','cliente@gmail.com','Calle Larios, 14');



