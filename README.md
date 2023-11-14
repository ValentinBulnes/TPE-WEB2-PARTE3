# TPE-WEB2-PARTE3

## Integrantes:
 - Valentin Bulnes (bulnesvalentin@gmail.com)
 - Valentino Copperi (valentinocopperi@gmail.com)

## Endpoints

### GET /productos

Obtiene una lista de todos los productos.

Parámetros de consulta opcionales:
- `sort`: Ordena los productos por este campo. Los valores permitidos son 'id_producto', 'nombre', 'precio', 'id_categoria', 'oferta'. Por defecto es 'id_producto'.
- `order`: La dirección del orden. Los valores permitidos son 'ASC', 'DESC', 'asc', 'desc'. Por defecto es 'ASC'.
- `page`: La página de resultados a mostrar. Por defecto es 1.
- `limit`: El número de resultados por página. Por defecto es 50.
- `categoria`: Filtra los productos por esta categoría.

Ejemplo de uso:

GET /api/productos?sort=precio&order=DESC&page=1&limit=10&categoria=Procesadores


### GET /productos/:ID

Obtiene el producto con el ID especificado.

Ejemplo de uso:

GET /api/productos/1


### POST /productos

Crea un nuevo producto.

Ejemplo de uso:

POST /api/productos Content-Type: application/json

{ “nombre”: “Nuevo producto”, “precio”: 100, “id_categoria”: 1, “oferta”: 0 }


### PUT /productos/:ID

Actualiza el producto con el ID especificado.

Ejemplo de uso:

PUT /api/productos/1 Content-Type: application/json

{ “nombre”: “Producto actualizado”, “precio”: 150, “id_categoria”: 2, “oferta”: 1 }


### DELETE /productos/:ID

Elimina el producto con el ID especificado.

Ejemplo de uso:

DELETE /api/productos/1

## Diagrama de Entidad-Relación:
![Diagrama de Entidad Relacion](https://github.com/ValentinBulnes/TPE-WEB2-PARTE3/blob/main/Diagrama%20de%20Entidad%20Relacion.png)
