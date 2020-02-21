---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Cars


<!-- START_b5807964b67925bcb310ef24f51967da -->
## List cars.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/cars?marca=nulla&modelo=qui&ano_min=nihil&ano_max=dolores&preco_min=rerum&preco_max=et&km_min=vel&km_max=quo&page=voluptatem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cars"
);

let params = {
    "marca": "nulla",
    "modelo": "qui",
    "ano_min": "nihil",
    "ano_max": "dolores",
    "preco_min": "rerum",
    "preco_max": "et",
    "km_min": "vel",
    "km_max": "quo",
    "page": "voluptatem",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (422):

```json
{
    "success": false,
    "message": "Validation error",
    "data": {
        "ano_min": [
            "The ano min must be an integer.",
            "The ano min must be between 1930 and 2020."
        ],
        "ano_max": [
            "The ano max must be an integer.",
            "The ano max must be between 1930 and 2020."
        ],
        "preco_min": [
            "The preco min must be an integer.",
            "The preco min must be between 2000 and 2000000."
        ],
        "preco_max": [
            "The preco max must be an integer.",
            "The preco max must be greater than or equal 5.",
            "The preco max must be between 2000 and 2000000."
        ],
        "km_min": [
            "The km min must be an integer."
        ],
        "km_max": [
            "The km max must be an integer."
        ],
        "page": [
            "The page must be an integer."
        ]
    }
}
```

### HTTP Request
`GET api/cars`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `marca` |  optional  | (string) Brand of the car.
    `modelo` |  optional  | (string) Model of the car.
    `ano_min` |  optional  | (integer) Minimum Year.
    `ano_max` |  optional  | (integer) Maximum Year.
    `preco_min` |  optional  | (integer) Minimum Price.
    `preco_max` |  optional  | (integer) Maximum Price.
    `km_min` |  optional  | (integer) Minimum Odometer.
    `km_max` |  optional  | (integer) Maximum Odometer.
    `page` |  optional  | (integer) Page.

<!-- END_b5807964b67925bcb310ef24f51967da -->

<!-- START_5835f3073a1fb3277b5fc35d89bad64e -->
## Show car details.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/cars/blanditiis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cars/blanditiis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/cars/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | (integer) The id of the car.

<!-- END_5835f3073a1fb3277b5fc35d89bad64e -->


