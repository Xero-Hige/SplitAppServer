define({ "api": [
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
