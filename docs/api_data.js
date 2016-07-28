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
            "field": "X-Auth-Facebook-ID",
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
            "field": "X-Auth-Facebook-ID",
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
          "content": "{\n   \"data\": [\n     {\n         \"id\": 1\n         \"name\": \"asd\",\n         \"when\": \"2016-07-25 19:30:00\",\n         \"when_iso\": \"2016-07-25T19:30:00-03:00\",\n         \"lat\": -53.04,\n         \"long\": -53.04,\n         \"invitees\": [\n             {\n                 \"facebook_id\": 231231231\n             },\n             {\n                 \"facebook_id\": 244\n             }\n         ],\n         \"tasks\": [\n             {\n                 \"assignee\": 231231231,\n                 \"name\": \"COMPRAR PAN\",\n                 \"cost\": 4.50,\n                 \"done\": true\n             },\n             {\n                 \"assignee\": 231231231,\n                 \"name\": \"COMPRAR QUESO\",\n                 \"cost\": null,\n                 \"done\": false\n             },\n         ]\n     }\n   ],\n   \"errors\": []\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/EventController.php",
    "groupTitle": "Event"
  },
  {
    "version": "0.0.1",
    "type": "post",
    "url": "/events/:event_id/invitees",
    "title": "Post event invitee",
    "description": "<p>Creates a new invitee.</p>",
    "name": "PostInvitee",
    "group": "EventInvitee",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Facebook-ID",
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
            "field": ":event_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "invitee",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/EventInviteeController.php",
    "groupTitle": "EventInvitee"
  },
  {
    "version": "0.0.1",
    "type": "post",
    "url": "/events",
    "title": "Post event",
    "description": "<p>Creates a new event. The user who creates the event will be the first invitee.</p>",
    "name": "PostEvent",
    "group": "Event",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Facebook-ID",
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
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "when",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lat",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "long",
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
            "field": "id",
            "description": "<p>New event id</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/EventController.php",
    "groupTitle": "Event"
  },
  {
    "version": "0.0.1",
    "type": "put",
    "url": "/events/:event_id",
    "title": "Update event",
    "description": "<p>Updates an event.</p>",
    "name": "PutEvent",
    "group": "Event",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Facebook-ID",
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
            "field": ":event_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "when",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lat",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "long",
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
            "field": "id",
            "description": "<p>event id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "when",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lat",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "long",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/EventController.php",
    "groupTitle": "Event"
  },
  {
    "version": "0.0.1",
    "type": "post",
    "url": "/events/:event_id/tasks",
    "title": "Post event task",
    "description": "<p>Creates a new task.</p>",
    "name": "PostTask",
    "group": "EventTask",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Facebook-ID",
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
            "field": ":event_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "assignee",
            "description": "<p>May be NULL</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "cost",
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
            "field": "id",
            "description": "<p>New event task id</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/EventTaskController.php",
    "groupTitle": "EventTask"
  },
  {
    "version": "0.0.1",
    "type": "put",
    "url": "/events/:event_id/tasks/:task_id",
    "title": "Put event task",
    "description": "<p>Updates a task.</p>",
    "name": "PutTask",
    "group": "EventTask",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Facebook-ID",
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
            "field": ":event_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": false,
            "field": ":task_id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "assignee",
            "description": "<p>May be NULL</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "cost",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Bool",
            "optional": false,
            "field": "done",
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
            "field": "id",
            "description": "<p>Event task id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "assignee",
            "description": "<p>May be NULL</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "cost",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "done",
            "description": ""
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/EventTaskController.php",
    "groupTitle": "EventTask"
  },
  {
    "version": "0.0.1",
    "type": "get",
    "url": "/tokens",
    "title": "Request user token",
    "description": "<p>Returns the user token. If the user doesn't exist, it creates the user and returns data anyway.</p>",
    "name": "GetToken",
    "group": "User",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Facebook-ID",
            "description": ""
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "X-Auth-Facebook-Token",
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
