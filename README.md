# Gestión de Habitaciones - Documentación del Proyecto

## Descripción del Proyecto
Este proyecto es un sistema básico de gestión hotelera diseñado para administrar habitaciones y usuarios de manera eficiente, segura y accesible. Incluye funcionalidades esenciales como la autenticación de usuarios, el registro y edición de habitaciones, y una interfaz intuitiva para la interacción del usuario.

---

## Objetivo
Proveer un sistema web capaz de gestionar operaciones clave en la administración de habitaciones, optimizando recursos y mejorando la experiencia tanto para administradores como para los usuarios finales.

---

## Tecnologías Utilizadas

### **Frontend**
- **HTML:** Estructura del contenido y uso de etiquetas semánticas.
- **CSS:** Estilos visuales, diseño responsivo y personalización.
- **JavaScript:** Interactividad, manipulación del DOM y uso de `localStorage`.

### **Backend**
- **PHP:** Lógica del servidor, gestión de autenticación, operaciones CRUD.
- **PDO:** Interacción con la base de datos de manera segura y eficiente.

### **Base de Datos**
- **MySQL:** Almacenamiento relacional para gestionar habitaciones y usuarios.

### **Servidor**
- **Apache:** Ejecución de scripts PHP y entrega de contenido web.

---

## Estructura del Proyecto

### **Frontend**
- Formularios para capturar datos de usuarios y habitaciones.
- Tablas dinámicas para la visualización de habitaciones.
- Diseño responsivo para diferentes dispositivos.

### **Backend**
- Archivos PHP para manejar la lógica:
  - `login.php`: Autenticación de usuarios.
  - `add_room.php`, `edit_room.php`, `delete_room.php`: Operaciones CRUD para habitaciones.
  - `db_connection.php`: Gestión de la conexión a la base de datos.

### **Base de Datos**
- Tablas relacionadas para manejar usuarios y habitaciones:
  - **Usuarios:** `user_id`, `username`, `password`.
  - **Habitaciones:** `room_id`, `room_number`, `room_type`, `price`, `availability`.

---

## Funcionalidades

### **Gestión de Usuarios**
- **Inicio de Sesión:** Validación de credenciales con hashing seguro (`password_hash`).
- **Cierre de Sesión:** Redirección y destrucción de la sesión del usuario.

### **Gestión de Habitaciones**
- **Crear:** Agregar nuevas habitaciones con número, tipo, precio y disponibilidad.
- **Editar:** Actualizar datos existentes de una habitación.
- **Eliminar:** Remover habitaciones del sistema.
- **Visualizar:** Mostrar una tabla dinámica con el inventario de habitaciones.

### **Persistencia en Navegador**
- Uso de `localStorage` para guardar datos temporales del formulario en caso de recargas inesperadas.

---

## Estructuras de Control
- **Condicionales (`if`, `else`):** Validación de usuario, autenticación y flujo lógico.
- **Repetición (`while`):** Iteración para mostrar datos en tablas.
- **Saltos (`header`, `exit`):** Redirección y finalización segura del script.

---

## Seguridad
1. **Protección de Contraseñas:**
   - Hashing mediante `password_hash` y validación con `password_verify`.
2. **Validación de Entradas:**
   - Validación de datos antes de ejecutarlos en la base de datos.
3. **Consultas Preparadas:**
   - Prevención de inyecciones SQL utilizando `PDO::prepare()` y `bindParam()`.

---

## Versiones del Proyecto

### **Versión 1.0**
- Sistema básico con autenticación de usuarios.
- Gestión inicial de habitaciones (CRUD básico).
- Diseño simple en HTML y CSS.

### **Versión 1.1**
- Mejoras de seguridad (hashing de contraseñas, consultas preparadas).
- Mensajes de error claros para el usuario.

### **Versión 1.2**
- Diseño responsivo con CSS avanzado.
- Uso de JavaScript para interactividad y `localStorage`.

---

## Ejecución del Proyecto

1. **Configurar la Base de Datos:**
   - Crear las tablas necesarias en MySQL:
     ```sql
     CREATE TABLE users (
         user_id INT AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(50) NOT NULL,
         password VARCHAR(255) NOT NULL
     );

     CREATE TABLE rooms (
         room_id INT AUTO_INCREMENT PRIMARY KEY,
         room_number VARCHAR(20) NOT NULL,
         room_type VARCHAR(50) NOT NULL,
         price DECIMAL(10,2) NOT NULL,
         availability BOOLEAN NOT NULL
     );
     ```

2. **Configurar el Entorno:**
   - Asegurarse de tener Apache, PHP y MySQL instalados.
   - Configurar el archivo `config.php` con credenciales de la base de datos.

3. **Ejecutar el Servidor:**
   - Iniciar Apache y acceder al proyecto mediante el navegador.

---

## Consideraciones Finales

### **Limitaciones**
- Actualmente no se incluye integración con sistemas externos (ERP o CRM).
- No se implementaron técnicas avanzadas como exportación de datos a JSON o XML.

### **Posibles Mejoras**
- Implementación de APIs REST para compartir datos.
- Integración con herramientas empresariales como ERPs.
- Implementación de roles de usuario para mayor control de acceso.

---

## Autor
**Andrei**  
Desarrollado como parte de un proyecto educativo para demostrar conceptos de desarrollo web y gestión de datos.

---

## Licencia
Proyecto de licencia libre.

