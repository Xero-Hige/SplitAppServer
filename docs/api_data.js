define({ "api": [
  {
    "type": "get",
    "url": "/token",
    "title": "Request user token",
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
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/UserController.php",
    "group": "_home_agustin_Documents_FIUBA_SplitAppServer_app_Http_Controllers_UserController_php",
    "groupTitle": "_home_agustin_Documents_FIUBA_SplitAppServer_app_Http_Controllers_UserController_php",
    "name": "GetToken"
  }
] });