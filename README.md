# Project Task

## Tech Stack

- Laravel
- Mysql

## API Services

- GET
- POST
- PATCH
- DELETE

### API Endpoint localhost:8000

## Functions Example

``` json
POST /teams
request:

{
  "name":”Platform”,
}

response:

{
  "id":"b7f32a21-b863-4dd1-bd86-e99e8961ffc6",
  "name”: “Platform”,
}
```

```json
GET /teams/:id
response:

{
  "id":"b7f32a21-b863-4dd1-bd86-e99e8961ffc6",
  "name”: “Platform”
}
```

``` json
POST /teams/:id/member
request:
{
    "name": "Vv",
    "email": "venkat.v@razorpay.com"
}
Response:
{
    "id": "b7f32a21-b863-4dd1-bd86-e99e8961ffc6",
    "name": "Vv",
    "email": "venkat.v@razorpay.com"
}
```

```json
DELETE /teams/:id/members/:id2

response:
HTTP 204 No Content
```

```json
POST /teams/:id/tasks
request:
{
    "title": "Deploy app on stage", //mandatory
    "description" : "We have built a new app which needs to be tested thoroughly", //optional
    "assignee_id": "some member id from the same team", // optional
    "status": "todo"
}
response:
{
    "id": "2a913e52-81ea-4987-874d-820969a62ea6",
    "title": "Deploy app on stage", //mandatory
    "description" : "We have built a new app which needs to be tested thoroughly", //optional
    "assignee_id": "some member id from the same team", // optional
    "status": "todo"
}
```

``` json
GET /teams/:id/tasks/:id2
response:
{
    "id": "2a913e52-81ea-4987-874d-820969a62ea6",
    "title": "Deploy app on stage", //mandatory
    "description" : "We have built a new app which needs to be tested thoroughly", //optional
    "assignee_id": "some member id from the same team", // optional
    "status": "todo"
}
```

``` json
PATCH /teams/:id/tasks/:id2
request:
{
    "title": "Deploy app on preprod",//optional
    "description":"new description",//optional
    "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",//optional
    "status": "done"
}
response:
{
    "id": "2a913e52-81ea-4987-874d-820969a62ea6",
    "title": "Deploy app on preprod",//optional
    "description":"new description",//optional
    "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",
    "status": "done"
}
```

``` json
GET /teams/:id/tasks/
response:
[
    {
        "id": "2a913e52-81ea-4987-874d-820969a62ea6",
        "title": "Deploy app on preprod",//optional
        "description":"new description",//optional
        "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",
        "status": "todo"
    },
]

```

``` json
GET /teams/:id/members/:id2/tasks/
response:
[
    {
        "id": "2a913e52-81ea-4987-874d-820969a62ea6",
        "title": "Deploy app on preprod",//optional
        "description":"new description",//optional
        "assignee_id": "745dbe00-2520-420a-985d-0c3f5d280e57",
        "status": "todo"
    },
]
```

## To Run locally

`$ php artisan migrate`

`$ php artisan serve`

## To Run on docker

`$ docker-compose up --build`

## **Attention**: Before running the API edit the env file, add Database username and password
