# API-REST

La descripcion de la API-REST se encuentra debajo.

URL: `http://localhost/WEB2_API/api/wines`

## GET Obtener producto

### Request

`GET /wines`

    Obtiene una lista con todos los productos disponibles.
    Por defecto la lista se encuentra ordenada por ID en forma descendente.

# Orden
`GET /wines?sort=vino&order=desc`

    Obtiene una lista con todos los productos disponibles ordenados por un campo y un orden determinado. 
    De no existir el campo y/o el orden devuelve la lista ordenada por defecto.

# Paginacion

`GET /wines?elem=6&limit=3`

    Obtiene una lista de tamaño limitado por los parametros de paginacion. 
    elem: determina el producto desde el que inicia. 
    limit: la cantidad de elementos a mostrar.

# Filtro
`GET /wines?filter=precio&value=1000`

    Obtiene una lista filtrada por el campo deseado. 
    Ejemplo: Precio = $1000.   

`GET /wines?filter=precio&value=1000&operator=>=`
    Ejemplo: Todos los precios mayores o iguales a 1000-.

# Aclaracion:
    Si los parametros son erroneos devuelve la lista completa.

### Response

#### 200

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json
    [{
        "id": 1,
        "vino": "Cordon Blanco",
        "bodega": "Cordon Blanco",
        "cepa": "Syrah",
        "anio": 2021,
        "precio": 2500,
        "stock": 12,
        "recomendado": 1
    },{
        ...
        }]

#### 204

    HTTP/1.1 204 No content
    Status: 204 No content
    "No hay elementos para mostrar"


## GET Obtiene producto por id

### Request

`GET /wines/id`

    Obtiene un producto especifico filtrado por id.

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    {"id": 1,
	"vino": "Cordon Blanco",
	"bodega": "Cordon blanco",
	"pais": "Argentina",
	"region": "Buenos Aires",
	"maridaje": "Carne",
	"cepa": "Syrah",
	"anio": 2021,
	"stock": 12,
	"precio": 2500,
	"caracteristica": "Este vino presenta características muy diferenciables que, sobre ciertos umbrales, 
                       recuerdan al lugar de origen: vinos más delicados en color, aromas exóticos y 
                       sabores con taninos suaves de su breve crianza en roble.",
	"recomendado": 1
    }

#### 404 Not found

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "El vino con con el ID = 'id' No existe"



## POST Crea nuevo producto


### Request

`POST /wines + Bearer TOKEN`


    Crea un nuevo producto.
    Se envia el siguiente JSON:

    {
    "vino": "String",
    "bodega": int,
	"maridaje": String,
    "cepa": String,
    "anio": int,
    "precio": int,
    "stock": int,
	"caracteristica" : String,
    "recomendado": boolean
}

# Aclaracion:
    El campo bodega tiene que coincidir con ID_BODEGA de la categoria correspondiente

### Response

#### 201 Created

    HTTP/1.1 201 Created
    Status: 201 Created
    Content-Type: application/json
    
    "El vino fue creado con exito con el ID = 'id' "

#### 400 Bad Request

    HTTP/1.1 400 Bad Request
    Status: Bad Request

    1 - 'Por favor completar todos los campos'
    2 - 'La bodega con con el ID = 'id_bodega' No existe'

#### 401 Unauthorized

    HTTP/1.1 401 Unauthorized
    Status: 401 Unauthorized
    "Usuario no autorizado"

## PUT Modifica un producto

    Modifica un producto especifico mediante id.

### Request

`PUT /wines/id + Bearer TOKEN`

 Se envia el siguiente JSON:

   {
    "vino": "String",
    "bodega": int,
	"maridaje": String,
    "cepa": String,
    "anio": int,
    "precio": int,
    "stock": int,
	"caracteristica" : String,
    "recomendado": boolean
}

# Aclaracion:
        Si algun campo no es cargado, no se actualiza. Mantine el valor que tenia.
        El campo bodega tiene que coincidir con ID_BODEGA de la categoria correspondiente

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    "El vino con ID = ' id ' fue actualizado con exito"

#### 400 Bad Request

    HTTP/1.1 400 Bad Request
    Status: Bad Request

    "No se puedo actualizar el ID = 'id' No existe"

#### 401 Unauthorized

    HTTP/1.1 401 Unauthorized
    Status: 401 Unauthorized
    "Usuario no autorizado"


## DELETE Elimina un producto

### Request

`DELETE /wines/id`

    Elimina el producto indicado mediante el id.

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK

    "Se elimino con exito el ID = 'id' "

#### 404 Not found

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "No se puedo eliminar el ID = ' id  ' No existe"


## GET TOKEN

### Request

`GET /wines/user/token`

    Basic Auth.

    user:"...";
    password: "...";

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






## GET Obtener Categoria

### Request

`GET /cellars`

    Obtiene una lista con todos las categorias disponibles.

# Orden
`GET /cellars?sort=bodega&order=desc`

    Obtiene una lista con todos las categorias disponibles ordenados por un campo y orden determinado.

# Paginacion
`GET /cellars?elem=6&limit=3`

    Obtiene una lista de tamaño limitado por los parametros de paginacion. 
    elem: determina la categoria desde el que inicia 
    limit: la cantidad a mostrar.

# Filtro
`GET /cellars?filter=pais&value=Argentina`

    Obtiene una lista filtrada por el campo deseado. 
    Ejemplo: Pais = Argentina

    Si se quiere ingresar un operador se debe hacer de la siguiente manera:

`GET /cellars?filter=provincia&value=men%&operator=LIKE`
    Ejemplo: Todos las categorias que empiecen la provincia con "med". 

# Aclaracion:
    Si los parametros son erroneos devuelve la lista completa.

### Response

#### 200

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json
    [{
		"id_bodega": 5,
		"nombre": "Catena Zapata",
		"pais": "Argentina",
		"provincia": "Mendoza",
		"descripcion": "Nuestra visión consiste en elaborar vinos intensos e inolvidables, 
                        verdaderamente expresivos del terroir. La historia de Catena es la 
                        historia del vino argentino."
	    },{
        ...
        }]

#### 204

    HTTP/1.1 204 No content
    Status: 204 No content
    "La bodega con con el ID = 'id' No existe"


## GET Obtiene Categoria por id

### Request

`GET /cellars/id`

    Obtiene un categoria especifica filtrado por id.

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

{
	"id_bodega": 6,
	"nombre": "Cordon Blanco",
	"pais": "Argentina",
	"provincia": "Buenos Aires",
	"descripcion": " Radicada en Tandil"
}

#### 404 Not found

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "La bodega con con el ID = "id". No existe"



## POST Crea nueva Categoria


### Request

`POST /cellars + Bearer TOKEN`


    Crea un nueva categoria.

    {
        "id_bodega": Autoincremental,
        "nombre": String,
        "pais": String,
        "provincia": String,
        "descripcion": String
    }

### Response

#### 201 Created

    HTTP/1.1 201 Created
    Status: 201 Created
    Content-Type: application/json

    "La bodega fue creada con exito con el ID = 'id'"

#### 400 Bad Request

    HTTP/1.1 400 Bad Request
    Status: Bad Request

    "No hay elementos para agregar"

#### 401 Unauthorized

    HTTP/1.1 401 Unauthorized
    Status: 401 Unauthorized
    "Usuario no autorizado"


## PUT Modifica una categoria

    Modifica una categoria especifico mediante id.

### Request

`PUT /wines/id + Bearer TOKEN`

    {
        "nombre": String,
        "pais": String,
        "provincia": String,
        "descripcion": String
    }

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK
    Content-Type: application/json

    "La bodega ID = 'id' fue actualizada con exito"

#### 401 Unauthorized

    HTTP/1.1 401 Unauthorized
    Status: 401 Unauthorized
    "Usuario no autorizado"


#### 400 Bad Request

    HTTP/1.1 400 Bad Request
    Status: Bad Request

    1 - "Ingrese los campos correctamente"
    2 - "No se puedo actualizar el ID = 'id' No existe"


## DELETE Elimina un producto

### Request

`DELETE /cellars/id`

    Elimina el producto indicado mediante el id.

### Response

#### 200 OK

    HTTP/1.1 200 OK
    Status: 200 OK

    "Se elimino con exito el ID = "id" "

#### 404 Not found

    HTTP/1.1 404 Not found
    Status: 404 Not found
    "No se puedo eliminar el ID = "id" No existe "

#### 400 Bad Request

    HTTP/1.1 400 Bad Request
    Status: Bad Request

    "Ingrese los campos correctamente"



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