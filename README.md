# REST API Jobs Posting

This is a simple API to posting a job using laravel 11

## Setup Environment
Please copy the env variables to .env

    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:4u3u8a+5pHcOq6oXzkCSD9qV2tng5htOJgLaLTbjgX0=
    APP_DEBUG=true
    APP_TIMEZONE=UTC
    APP_URL=http://localhost

    APP_LOCALE=en
    APP_FALLBACK_LOCALE=en
    APP_FAKER_LOCALE=en_US

    APP_MAINTENANCE_DRIVER=file
    APP_MAINTENANCE_STORE=database

    BCRYPT_ROUNDS=12

    LOG_CHANNEL=stack
    LOG_STACK=single
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=jobs_posting
    DB_USERNAME=root
    DB_PASSWORD=
    DB_COLLATION=utf8mb4_unicode_ci

    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null

    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=database

    CACHE_STORE=database
    CACHE_PREFIX=

    MEMCACHED_HOST=127.0.0.1

    REDIS_CLIENT=phpredis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=log
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false

    VITE_APP_NAME="${APP_NAME}"

    JWT_SECRET=upNQAd1YtlMoPpss64xpViPHS7sDmRshQb9NXgb6FWn5W9FnoBtTgdnLD1bX9Iz0

    JWT_SHOW_BLACKLIST_EXCEPTION=true

## Run DB Migration

    php artisan migrate

## Run DB Seeder

    php artisan db:seed

## Run the app

    php artisan serve

## Run the tests

    php artisan test

# REST API

The REST API to Jobs Posting app is described below.

## Register User

### Request

`POST /api/register`

    curl -X POST \
    -d '{"name": "Tester","email": "tester@mail.com", "password": "password", "password_confirmation": "password"}' \
    http://127.0.0.1:8000/api/register

### Response

    {
        "success": true,
        "message": "Register success!",
        "data": {
            "name": "Tester",
            "email": "tester@mail.com",
            "updated_at": "2024-11-22T04:22:02.000000Z",
            "created_at": "2024-11-22T04:22:02.000000Z",
            "id": 13
        }
    }

## Login User

### Request

`POST /api/login`

    curl -X POST \
    -d '{"email": "tester@mail.com", "password": "password"}' \
    http://127.0.0.1:8000/api/login

### Response

    {
        "success": true,
        "message": "Success create token!",
        "data": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.  eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzMyMjQ5NTY2LCJleHAiOjE3MzIyNTMxNjYsIm5iZiI6MTczMjI0OTU2NiwianRpIjoiUUI4QjBQajBJMmFtUnZLbSIsInN1YiI6IjEzIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.W7cmGPbr2mQbbQSloh9tyXYRvJm3iCagb-Ll69Ccb6k"
    }

## Logout User

### Request

`POST /api/logout`

    curl -X POST \
    -H "Authorization: Bearer your_access_token" \
    http://127.0.0.1:8000/api/logout

### Response

    {
        "success": true,
        "message": "Logout success!",
        "data": []
    }

## Get list of Jobs

### Request

`GET /api/vacancies`

    curl -X GET \
    http://127.0.0.1:8000/api/vacancies

### Response

    {
    "success": true,
    "message": "Vacancies data list.",
    "data": {
        "current_page": 1,
        "data": [
            {
                "vacancy_id": "0a7e52ef-1613-3c19-83b3-d121e9a178ba",
                "title": "Shipping and Receiving Clerk",
                "description": "Et aperiam corporis illo qui aut.",
                "requirement": "Nobis et ut minus rerum.",
                "status": "draft",
                "company_name": "Collins, Quitzon and Renner",
                "created_at": "2024-11-22T04:21:45.000000Z",
                "updated_at": "2024-11-22T04:21:45.000000Z"
            },
            {
                "vacancy_id": "10d3ea2d-0ca7-3058-a7f7-8b600631bec8",
                "title": "Calibration Technician OR Instrumentation Technician",
                "description": "Quisquam quis dolorem assumenda et eius.",
                "requirement": "Laudantium est nostrum aut.",
                "status": "draft",
                "company_name": "Collins, Simonis and Zboncak",
                "created_at": "2024-11-22T04:21:45.000000Z",
                "updated_at": "2024-11-22T04:21:45.000000Z"
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/vacancies?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/vacancies?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/vacancies?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/vacancies",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
}

## Get a specific Job

### Request

`GET /api/vacancies/:vacancy_id`

    curl -X GET \
    http://127.0.0.1:8000/api/vacancies/0a7e52ef-1613-3c19-83b3-d121e9a178ba

### Response

    {
        "success": true,
        "message": "Detail Data Vacancy!",
        "data": [
            {
                "vacancy_id": "0a7e52ef-1613-3c19-83b3-d121e9a178ba",
                "title": "Shipping and Receiving Clerk",
                "description": "Et aperiam corporis illo qui aut.",
                "requirement": "Nobis et ut minus rerum. ",
                "status": "draft",
                "company_name": "Collins, Quitzon and Renner",
                "created_at": "2024-11-22T04:21:45.000000Z",
                "updated_at": "2024-11-22T04:21:45.000000Z"
            }
        ]
    }

## Create a new Job

### Request

`POST /api/vacancies`

    curl -X POST \
    -H "Authorization: Bearer your_access_token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title": "English Teacher", "description": "Qui exercitationem et quasi et.", "requirement": "Dignissimos amet suscipit est autem sed velit fuga accusantium.", "status": "publish", "company_name": "SMM"}' \
    http://127.0.0.1:8000/api/vacancies

### Response

    {
        "success": true,
        "message": "Vacancy success added!",
        "data": {
            "vacancy_id": "4064b2cf-247e-48ff-996b-d9eb64123110",
            "title": "English Teacher",
            "description": "Qui exercitationem et quasi et.",
            "requirement": "Dignissimos amet suscipit est autem sed velit fuga accusantium.",
            "status": "publish",
            "company_name": "SMM",
            "updated_at": "2024-11-22T04:55:57.000000Z",
            "created_at": "2024-11-22T04:55:57.000000Z"
        }
    }

## Change a Job

### Request

`PUT http://127.0.0.1:8000/api/vacancies/:vacancy_id`

    curl -X PUT \
    -H "Authorization: Bearer your_access_token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title": "Math Teacher", "description": "Qui exercitationem et quasi et.", "requirement": "Dignissimos amet suscipit est autem sed velit fuga accusantium.", "status": "publish", "company_name": "SMM"}' \
    http://127.0.0.1:8000/api/vacancies

### Response

    {
        "success": true,
        "message": "Vacancy success updated!",
        "data": 1
    }

## Apply a Job

### Request

`POST /api/applies`

    curl -X POST \
    -d '{"vacancy_id": "02dd9916-a911-3deb-8487-f71a5b760624", "candidate_id": "0c6ff7d0-294f-35e4-be45-eb31b6b2a463"}' \
    http://127.0.0.1:8000/api/applies

### Response

    {
        "success": true,
        "message": "Apply success saved!",
        "data": {
            "apply_id": "f9421b7f-e3d3-425f-8c56-39abf28261b7",
            "vacancy_id": "0a7e52ef-1613-3c19-83b3-d121e9a178ba",
            "candidate_id": "0804a093-d2b3-30fe-8fc5-80dd58802371",
            "status": "new",
            "updated_at": "2024-11-22T05:07:19.000000Z",
            "created_at": "2024-11-22T05:07:19.000000Z"
        }
    }

## Change a Apply status

### Request

`PUT http://127.0.0.1:8000/api/applies/:apply_id`

    curl -X PUT \
    -H "Authorization: Bearer your_access_token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"vacancy_id": "0a7e52ef-1613-3c19-83b3-d121e9a178ba", "candidate_id": "0804a093-d2b3-30fe-8fc5-80dd58802371", "status": "accept" }' \
    http://127.0.0.1:8000/api/applies/f9421b7f-e3d3-425f-8c56-39abf28261b7

### Response

    {
        "success": true,
        "message": "Apply success updated!",
        "data": 1
    }

## Show all candidates who apply by specific vacancy id

### Request

`GET /api/applies/candidates/:vacancy_id`

    curl -X GET \
    -H "Authorization: Bearer your_access_token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    http://127.0.0.1:8000/api/applies/candidates/1a7b53cf-509f-33e6-a387-9c8aa6f8e247

### Response

    {
        "success": true,
        "message": "Show all candidates who apply Shipping and Receiving Clerk",
        "data": [
            {
                "candidate_id": "0804a093-d2b3-30fe-8fc5-80dd58802371",
                "name": "Mr. Dayne Maggio",
                "email": "bryon92@example.net",
                "phone": "+1-351-723-4513",
                "experience": "Occaecati molestiae et consequatur harum.",
                "education": "Possimus eos vel animi veniam itaque praesentium. Qui asperiores maxime ducimus quas velit modi id.",
                "created_at": "2024-11-22T04:21:45.000000Z",
                "updated_at": "2024-11-22T04:21:45.000000Z",
                "pivot": {
                    "vacancy_id": "0a7e52ef-1613-3c19-83b3-d121e9a178ba",
                    "candidate_id": "0804a093-d2b3-30fe-8fc5-80dd58802371"
                }
            }
        ]
    }

## show all vacancies that applied by speccific candidate id

### Request

`GET /api/applies/vacancies/:candidate_id`

    curl -X GET \
    -H "Authorization: Bearer your_access_token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    http://127.0.0.1:8000/api/applies/vacancies/0804a093-d2b3-30fe-8fc5-80dd58802371

### Response

    {
        "success": true,
        "message": "Show all vacancies who apply by Mr. Dayne Maggio",
        "data": [
            {
                "vacancy_id": "0a7e52ef-1613-3c19-83b3-d121e9a178ba",
                "title": "Shipping and Receiving Clerk",
                "description": "Et aperiam corporis illo qui aut. Aut hic occaecati et officia temporibus aut.",
                "requirement": "Nobis et ut minus rerum. Atque quae ea dicta doloribus. Reiciendis et est totam ex sapiente. Architecto ea occaecati natus vel dolor.",
                "status": "draft",
                "company_name": "Collins, Quitzon and Renner",
                "created_at": "2024-11-22T04:21:45.000000Z",
                "updated_at": "2024-11-22T04:21:45.000000Z",
                "pivot": {
                    "candidate_id": "0804a093-d2b3-30fe-8fc5-80dd58802371",
                    "vacancy_id": "0a7e52ef-1613-3c19-83b3-d121e9a178ba"
                }
            }
        ]
    }
