<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

Rest API implementation on Laravel 7.4.

Main features:
* Migrations (./database/migrations);
* Seeding and Faker Factory (./database/seeds);
* Rich REST API with pagination (./app/Http/Controllers).


# Requirements
PHP 7.2.5+

# Installation
    1. cd /path/to/the/laravel-rest/
    2. cp .env.example .env
    3. *edit the .env file*
    4. composer install
    5. php artisan migrate:refresh
    6. php artisan db:seed

# Launch
    php artisan serve

# API

## Endpoints:
    GET /api/countries 
    GET /api/countries/{country_id}
    GET /api/regions
    GET /api/regions/{region_id}
    GET /api/cities
    GET /api/cities/{city_id}
    GET /api/streets
    GET /api/streets/{street_id}
    GET /api/buildings
    GET /api/buildings/{building_id}
    GET /api/citizens
    GET /api/citizens/{citizen_id}
    GET /api/cars
    GET /api/cars/{car_id}
    GET /api/colors
    GET /api/colors/{color_id}
    GET /api/car_brands
    GET /api/car_brands/{car_brand_id}


## Expandable Models

This API has a support of model expanding to limit unnecessary API calls

### API call without expanding

#### Request
    curl http://127.0.0.1:8000/api/cars

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "brand_id": 6,
          "color_id": 15,
          "plate_number": "DULWCZ"
        },
        {
          "id": 2,
          "brand_id": 25,
          "color_id": 8,
          "plate_number": "BCQNMT"
        },
        {
          "id": 3,
          "brand_id": 61,
          "color_id": 13,
          "plate_number": "MZIQJD"
        },
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/cars?page=1",
      "from": 1,
      "last_page": 4,
      "last_page_url": "http://127.0.0.1:8000/api/cars?page=4",
      "next_page_url": "http://127.0.0.1:8000/api/cars?page=2",
      "path": "http://127.0.0.1:8000/api/cars",
      "per_page": 30,
      "prev_page_url": null,
      "to": 30,
      "total": 100
    }


### API call with expanding

#### Request
    curl http://127.0.0.1:8000/api/cars?expand[]=color&expand[]=brand
    
#### Response
 
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "brand_id": 6,
          "color_id": 15,
          "plate_number": "DULWCZ",
          "color": {
            "id": 15,
            "name": "Moccasin"
          },
          "brand": {
            "id": 6,
            "name": "BMW"
          }
        },
        {
          "id": 2,
          "brand_id": 25,
          "color_id": 8,
          "plate_number": "BCQNMT",
          "color": {
            "id": 8,
            "name": "PaleGreen"
          },
          "brand": {
            "id": 25,
            "name": "Infiniti"
          }
        },
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/cars?page=1",
      "from": 1,
      "last_page": 4,
      "last_page_url": "http://127.0.0.1:8000/api/cars?page=4",
      "next_page_url": "http://127.0.0.1:8000/api/cars?page=2",
      "path": "http://127.0.0.1:8000/api/cars",
      "per_page": 30,
      "prev_page_url": null,
      "to": 30,
      "total": 100
    }
    
    
    
## API Usage Samples

### 1. Fetch all people living in the city
#### Request
    curl http://127.0.0.1:8000/api/citizens?city=Daretown
    
#### Response

    {
      "current_page": 1,
      "data": [
        {
          "id": 2,
          "name": "Mr. Oswaldo McDermott",
          "date_of_birth": "1978-03-09",
          "citizen_id": 2,
          "address": "McDermott Skyway 6260, Daretown, British Columbia, Canada"
        },
        {
          "id": 4,
          "name": "Mr. Eugene Heathcote",
          "date_of_birth": "1973-07-12",
          "citizen_id": 4,
          "address": "Tina Estate 3690, Daretown, British Columbia, Canada"
        },
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/citizens?page=1",
      "from": 1,
      "last_page": 4,
      "last_page_url": "http://127.0.0.1:8000/api/citizens?page=4",
      "next_page_url": "http://127.0.0.1:8000/api/citizens?page=2",
      "path": "http://127.0.0.1:8000/api/citizens",
      "per_page": 100,
      "prev_page_url": null,
      "to": 100,
      "total": 344
    }
    
    
### 2. Fetch all cars when providing a particular street name
#### Request
    curl http://127.0.0.1:8000/api/cars?street_like=Has&expand[]=buildingCar.building.street
    
#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 40,
          "brand_id": 22,
          "color_id": 9,
          "plate_number": "CJGSTZ",
          "building_car": [
            {
              "building_id": 183,
              "car_id": 40,
              "building": {
                "id": 183,
                "street_id": 38,
                "building_number": 4460,
                "street": {
                  "id": 38,
                  "city_id": 1,
                  "name": "Hassie Parkways"
                }
              }
            }
          ]
        },
        {
          "id": 79,
          "brand_id": 42,
          "color_id": 5,
          "plate_number": "OGAPFJ",
          "building_car": [
            {
              "building_id": 203,
              "car_id": 79,
              "building": {
                "id": 203,
                "street_id": 38,
                "building_number": 3890,
                "street": {
                  "id": 38,
                  "city_id": 1,
                  "name": "Hassie Parkways"
                }
              }
            }
          ]
        }
      ],
      "first_page_url": "http://127.0.0.1:8000/api/cars?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/cars?page=1",
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/cars",
      "per_page": 30,
      "prev_page_url": null,
      "to": 2,
      "total": 2
    }


### 3. Fetch the owner(s) of a vehicle when providing a license plate
#### Request
    curl http://127.0.0.1:8000/api/cars?plate_number=RSIMQY&expand[]=buildingCar.building.tenants.citizen
    
#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 98,
          "brand_id": 4,
          "color_id": 9,
          "plate_number": "RSIMQY",
          "building_car": [
            {
              "building_id": 42,
              "car_id": 98,
              "building": {
                "id": 42,
                "street_id": 36,
                "building_number": 3590,
                "tenants": [
                  {
                    "building_id": 42,
                    "citizen_id": 124,
                    "citizen": {
                      "id": 124,
                      "name": "Samir Langworth",
                      "date_of_birth": "1978-05-06"
                    }
                  },
                  {
                    "building_id": 42,
                    "citizen_id": 136,
                    "citizen": {
                      "id": 136,
                      "name": "Colten Sporer",
                      "date_of_birth": "1980-05-24"
                    }
                  },
                  {
                    "building_id": 42,
                    "citizen_id": 305,
                    "citizen": {
                      "id": 305,
                      "name": "Coralie Kohler",
                      "date_of_birth": "1997-08-06"
                    }
                  },
                  {
                    "building_id": 42,
                    "citizen_id": 368,
                    "citizen": {
                      "id": 368,
                      "name": "Mr. Granville Blanda PhD",
                      "date_of_birth": "2004-07-19"
                    }
                  }
                ]
              }
            }
          ]
        }
      ],
      "first_page_url": "http://127.0.0.1:8000/api/cars?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/cars?page=1",
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/cars",
      "per_page": 30,
      "prev_page_url": null,
      "to": 1,
      "total": 1
    }


### 4. Fetch the full address and street of a house when providing a person's name
#### Request
    http://127.0.0.1:8000/api/citizens?name=Samir%20Langworth&expand[]=buildingTenant.building.street.city.region.country
    
#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 124,
          "name": "Samir Langworth",
          "date_of_birth": "1978-05-06",
          "address": "Harry Run 3590, Lake Suzannemouth, Saskatchewan, Canada",
          "building_tenant": [
            {
              "building_id": 42,
              "citizen_id": 124,
              "building": {
                "id": 42,
                "street_id": 36,
                "building_number": 3590,
                "street": {
                  "id": 36,
                  "city_id": 1,
                  "name": "Harry Run",
                  "city": {
                    "id": 1,
                    "region_id": 8,
                    "name": "Lake Suzannemouth",
                    "region": {
                      "id": 8,
                      "country_id": 124,
                      "name": "Saskatchewan",
                      "code": "SK",
                      "country": {
                        "id": 124,
                        "name": "Canada",
                        "code": "CA",
                        "code_long": "CAN"
                      }
                    }
                  }
                }
              }
            }
          ]
        }
      ],
      "first_page_url": "http://127.0.0.1:8000/api/citizens?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/citizens?page=1",
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/citizens",
      "per_page": 100,
      "prev_page_url": null,
      "to": 1,
      "total": 1
    }


## Countries

### GET /api/countries

#### Request
    curl http://127.0.0.1:8000/api/countries

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 124,
          "name": "Canada",
          "code": "CA",
          "code_long": "CAN"
        }
      ],
      "first_page_url": "http://127.0.0.1:8000/api/countries?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/countries?page=1",
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/countries",
      "per_page": 100,
      "prev_page_url": null,
      "to": 1,
      "total": 1
    }

### GET /api/countries/{country_id}

#### Request
    curl http://127.0.0.1:8000/api/countries/1

#### Response
    {
      "id": 124,
      "name": "Canada",
      "code": "CA",
      "code_long": "CAN"
    }




## Regions

### GET /api/regions

#### Optional params:
* `expand` (array), possible values: `country`.


#### Request
    curl http://127.0.0.1:8000/api/regions

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "country_id": 124,
          "name": "Ontario",
          "code": "ON"
        },
        {
          "id": 2,
          "country_id": 124,
          "name": "Quebec",
          "code": "QC"
        },
        {
          "id": 3,
          "country_id": 124,
          "name": "Nova Scotia",
          "code": "NS"
        },
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/regions?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/regions?page=1",
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/regions",
      "per_page": 15,
      "prev_page_url": null,
      "to": 13,
      "total": 13
    }

### GET /api/regions/{region_id}

#### Request
    curl http://127.0.0.1:8000/api/regions/1

#### Response
    {
      "id": 1,
      "country_id": 124,
      "name": "Ontario",
      "code": "ON"
    }



## Cities

### GET /api/cities

#### Optional params:
* `expand` (array), possible values: `region`, `region.country`.


#### Request
    curl http://127.0.0.1:8000/api/cities

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "region_id": 6,
          "name": "Daretown"
        }
      ],
      "first_page_url": "http://127.0.0.1:8000/api/cities?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/cities?page=1",
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/cities",
      "per_page": 25,
      "prev_page_url": null,
      "to": 1,
      "total": 1
    }

### GET /api/cities/{city_id}

#### Request
    curl http://127.0.0.1:8000/api/cities/1

#### Response
    {
      "id": 1,
      "region_id": 6,
      "name": "Daretown"
    }




## Streets

### GET /api/streets

#### Optional params:
* `expand` (array), possible values: `city`, `city.region`, `city.region.country`.



#### Request
    curl http://127.0.0.1:8000/api/streets

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "city_id": 1,
          "name": "Mante Groves"
        },
        {
          "id": 2,
          "city_id": 1,
          "name": "Adah Mill"
        },
        {
          "id": 3,
          "city_id": 1,
          "name": "D'Amore Flat"
        },
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/streets?page=1",
      "from": 1,
      "last_page": 2,
      "last_page_url": "http://127.0.0.1:8000/api/streets?page=2",
      "next_page_url": "http://127.0.0.1:8000/api/streets?page=2",
      "path": "http://127.0.0.1:8000/api/streets",
      "per_page": 50,
      "prev_page_url": null,
      "to": 50,
      "total": 75
    }

### GET /api/streets/{street_id}

#### Request
    curl http://127.0.0.1:8000/api/street/1

#### Response
    {
      "id": 1,
      "city_id": 1,
      "name": "Mante Groves"
    }



## Buildings

### GET /api/buildings

#### Optional params:
* `expand` (array), possible values: `street`, `street.city`, `street.city.region`, `steet.city.region.country`



#### Request
    curl http://127.0.0.1:8000/api/buildings

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "street_id": 41,
          "building_number": 3030
        },
        {
          "id": 2,
          "street_id": 53,
          "building_number": 4040
        },
        {
          "id": 3,
          "street_id": 70,
          "building_number": 940
        },
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/buildings?page=1",
      "from": 1,
      "last_page": 3,
      "last_page_url": "http://127.0.0.1:8000/api/buildings?page=3",
      "next_page_url": "http://127.0.0.1:8000/api/buildings?page=2",
      "path": "http://127.0.0.1:8000/api/buildings",
      "per_page": 100,
      "prev_page_url": null,
      "to": 100,
      "total": 300
    }

### GET /api/buildings/{building_id}

#### Request
    curl http://127.0.0.1:8000/api/buildings/1

#### Response
    {
      "id": 1,
      "street_id": 41,
      "building_number": 3030
    }






## Citizens

### GET /api/citizens

#### Optional params:
* `expand` (array), possible values: `buildingTenant`,
`buildingTenant.building`,
`buildingTenant.building.street`,
`buildingTenant.building.street.city`,
`buildingTenant.building.street.city.region`,
`buildingTenant.building.street.city.region.country`;
* `name` (string);
* `name_like` (string);
* `street_id` (int);
* `street` (string);
* `street_like` (string);
* `city_id` (int);
* `city` (string);
* `city_like` (string).

#### Request
    curl http://127.0.0.1:8000/api/citizens

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "name": "Mr. Oswaldo McDermott",
          "date_of_birth": "1978-03-09",
          "address": "McDermott Skyway 6260, Daretown, British Columbia, Canada"
        },
        {
          "id": 2,
          "name": "Mr. Eugene Heathcote",
          "date_of_birth": "1973-07-12",
          "address": "Tina Estate 3690, Daretown, British Columbia, Canada"
        },
        {
          "id": 3,
          "name": "Ms. Alanna Crona IV",
          "date_of_birth": "1987-06-05",
          "address": "Darwin Wells 2810, Daretown, British Columbia, Canada"
        }
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/citizens?page=1",
      "from": 1,
      "last_page": 4,
      "last_page_url": "http://127.0.0.1:8000/api/citizens?page=4",
      "next_page_url": "http://127.0.0.1:8000/api/citizens?page=2",
      "path": "http://127.0.0.1:8000/api/citizens",
      "per_page": 100,
      "prev_page_url": null,
      "to": 100,
      "total": 344
    }

### GET /api/citizens/{citizen_id}

#### Request
    curl http://127.0.0.1:8000/api/citizens/1

#### Response
    {
      "id": 1,
      "name": "Mr. Oswaldo McDermott",
      "date_of_birth": "1978-03-09",
      "address": "McDermott Skyway 6260, Daretown, British Columbia, Canada"
    }


## Cars

### GET /api/cars

#### Optional params:

* `expand` (array), possible values: `color`, `brand`, `buildingCar.building`, `buildingCar.building.tenants`, `buildingCar.building.tenants.citizen`, `buildingCar.building.street`, `buildingCar.building.street.city`;
* `plate_number` (string);
* `street_id` (int);
* `street` (string);
* `street_like` (string);

#### Request
    curl http://127.0.0.1:8000/api/cars

#### Response
    {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "brand_id": 6,
          "color_id": 15,
          "plate_number": "DULWCZ"
        },
        {
          "id": 2,
          "brand_id": 25,
          "color_id": 8,
          "plate_number": "BCQNMT"
        },
        {
          "id": 3,
          "brand_id": 61,
          "color_id": 13,
          "plate_number": "MZIQJD"
        },
        
        ...
      ],
      "first_page_url": "http://127.0.0.1:8000/api/cars?page=1",
      "from": 1,
      "last_page": 4,
      "last_page_url": "http://127.0.0.1:8000/api/cars?page=4",
      "next_page_url": "http://127.0.0.1:8000/api/cars?page=2",
      "path": "http://127.0.0.1:8000/api/cars",
      "per_page": 30,
      "prev_page_url": null,
      "to": 30,
      "total": 100
    }

### GET /api/cars/{car_id}

#### Request
    curl http://127.0.0.1:8000/api/cars/1

#### Response
    {
      "id": 1,
      "brand_id": 6,
      "color_id": 15,
      "plate_number": "DULWCZ"
    }



## License

[MIT license](https://opensource.org/licenses/MIT).