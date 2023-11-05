# API-REST

La descripcion de la API-REST se encuentra debajo.

URL: `http://localhost/WEB2_API/api/wines`

## GET Obtener producto

### Request

`GET /wines`

    Obtiene una lista con todos los productos disponibles.

`GET /wines?sort=nombre&order=desc`

    Obtiene una lista con todos los productos disponibles ordenados por una columna y orden determinado.

`GET /wines?page=6&limit=3`

    Obtiene una lista de tamaño limitado por los parametros de paginacion. Page determina el producto desde el que inicia y limit la cantidad a mostrar.

`GET /wines?recomendado=1`

    Obtiene una lista filtrada por el campo deseado. 
    Ejemplo: recomendado. Si el campo tieme valor 1 se agrega a la lista, si tiene 0 no.


### Response

#### 200

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json
    [{
        "id": 1,
        "nombre": "Cordon Blanco",
        "bodega": "Cordon Blanco",
        "cepa": "Syrah",
        "anio": 2021,
        "precio": 2500,
        "stock": 12,
        "recomendado": 1
},{
        ...
    }]

#### 404

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "Producto no encontrado"


## GET Obtiene producto por id

### Request

`GET /wines/id`

    Obtiene un producto especifico filtrado por id.

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    {
        "id": 3,
        "nombre": "Cordon Blanco",
        "bodega": "Cordon Blanco",
        "cepa": "Sauvignon Blanc",
        "anio": 2021,
        "precio": 6500,
        "stock": 4,
        "recomendado": 1
    }

#### 404 Not found

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "Producto no encontrado"



## POST Crea nuevo producto


### Request

`POST /wines + Bearer TOKEN`


    Crea un nuevo producto.

    {
        "nombre": String,
        "bodega": int,
        "cepa": String,
        "anio": int,
        "precio": int,
        "stock": int,
        "recomendado": boolean (0-1)
    }

# Aclaracion:
    El campo bodega tiene que coincidir con ID_BODEGA de la categoria correspondiente

### Response

#### 201 Created

    HTTP/1.1 201 Created
    Status: 201 Created
    Content-Type: application/json

    {
        "id": "generado por db"
        "nombre": "Cordon Blanco",
        "bodega": "1",
        "cepa": "Sauvignon Blanc",
        "anio": 2021,
        "precio": 6500,
        "stock": 4,
        "recomendado": 1
    }

#### 400 Bad Request

    HTTP/1.1 400 Bad Request
    Status: Bad Request

    "El producto no fue creado"

## PUT Modifica un producto

    Modifica un producto especifico mediante id.

### Request

`PUT /wines/id + Bearer TOKEN`

    {
        "nombre": String,
        "bodega": int,
        "cepa": String,
        "anio": int,
        "precio": int,
        "stock": int,
        "recomendado": boolean (0-1)
    }

# Aclaracion:
        El campo bodega tiene que coincidir con ID_BODEGA de la categoria correspondiente

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    {
        "id": int,
        "nombre": "Cordon Blanco",
        "bodega": "1",
        "cepa": "Sauvignon Blanc",
        "anio": 2021,
        "precio": 6500,
        "stock": 4,
        "recomendado": 1
    }

#### 400 Bad Request

    HTTP/1.1 400 Bad Request
    Status: Bad Request

    "Ingrese los campos correctamente"

#### 404 Not found

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "El producto con el 'id' no existe."

## DELETE Elimina un producto

### Request

`DELETE /wines/id`

    Elimina el producto indicado mediante el id.

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK

    "Articulo con 'id' eliminado"

#### 404 Not found

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "'id' no encontrado."


## GET TOKEN

### Request

`GET /wines/user/token`

    Basic Auth.

    user:" ";
    password: " ";

    Se solicita token para poder realizar request de PUT y POST

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK

    "Devuelve TOKEN generado"

#### 401 Unauthorized

    HTTP/1.1 401 Unauthorized
    Status: 401 Unauthorized
    "Los encabezados de Autenticacion son incorrectos"