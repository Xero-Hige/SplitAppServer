define({ "api": [
  {
    "version": "0.0.1",
    "type": "get",
    "url": "/events/:event_id",
    "title": "Get event",
    "description": "<p>Returns the event.</p>",
    "name": "GetEvent",
    "group": "Event",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-UserID",
            "description": "<p>Facebook ID for the user</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Token",
            "description": "<p>Token retrieved using /token</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": "event_id",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n   \"data\": {\n       \"name\": \"asd\",\n       \"when\": \"2016-07-25 19:30:00\",\n       \"when_iso\": \"2016-07-25T19:30:00-03:00\",\n       \"lat\": -53.04,\n       \"long\": -53.04,\n       \"invitees\": [\n           {\n               \"facebook_id\": 231231231\n           },\n           {\n               \"facebook_id\": 244\n           }\n       ],\n       \"tasks\": [\n           {\n               \"assignee\": 231231231,\n               \"name\": \"COMPRAR PAN\",\n               \"cost\": 4.50,\n               \"done\": true\n           },\n           {\n               \"assignee\": 231231231,\n               \"name\": \"COMPRAR QUESO\",\n               \"cost\": null,\n               \"done\": false\n           },\n       ]\n   },\n   \"errors\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/EventController.php",
    "groupTitle": "Event"
  },
  {
    "version": "0.0.1",
    "type": "get",
    "url": "/events/",
    "title": "Get events",
    "description": "<p>Returns the event list.</p>",
    "name": "GetEvents",
    "group": "Event",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-UserID",
            "description": "<p>Facebook ID for the user</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Token",
            "description": "<p>Token retrieved using /token</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success response",
          "content": "{\n   \"data\": [\n     {\n         \"name\": \"asd\",\n         \"when\": \"2016-07-25 19:30:00\",\n         \"when_iso\": \"2016-07-25T19:30:00-03:00\",\n         \"lat\": -53.04,\n         \"long\": -53.04,\n         \"invitees\": [\n             {\n                 \"facebook_id\": 231231231\n             },\n             {\n                 \"facebook_id\": 244\n             }\n         ],\n         \"tasks\": [\n             {\n                 \"assignee\": 231231231,\n                 \"name\": \"COMPRAR PAN\",\n                 \"cost\": 4.50,\n                 \"done\": true\n             },\n             {\n                 \"assignee\": 231231231,\n                 \"name\": \"COMPRAR QUESO\",\n                 \"cost\": null,\n                 \"done\": false\n             },\n         ]\n     }\n   ],\n   \"errors\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/EventController.php",
    "groupTitle": "Event"
  },
  {
    "version": "0.0.1",
    "type": "get",
    "url": "/token",
    "title": "Request user token",
    "description": "<p>Returns the user token. If the user doesn't exist, it creates the user and returns data anyway.</p>",
    "name": "GetToken",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "facebook_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "facebook_token",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Int",
            "optional": false,
            "field": "user_id",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success response",
          "content": "{\n \"data\": {\"user_id\": 1, \"token\": \"sdsjakldasjdaldkj\"},\n \"errors\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  }
] });
