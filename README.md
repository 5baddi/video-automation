![V12 Software](logo.png?raw=true)
# Social Videos Automation
### An app to auto generate videos from content of [V12 Software](https://www.v12software.com) plat-form using the [VAU API](https://vauvideo.com) features.
[Developed by Mohamed BADDI](https://github.com/5baddi)

---
**Retrieve all the custom templates**
---

Show data of all the exists custom templates

* **URL**

    /api/v1/templates

* **Method**

    GET

* **URL Params**

    None

* **Data Params**

    None

* **Success Response**

    * **Code:** 200 </br>
    * **Content:**
      ```json
      {
          "data": 
          [
                {
                    "id": 14,
                    "vau_id": 26,
                    "name": "Laidback Swingy Slides",
                    "package": null,
                    "version": null,
                    "rotation": "square",
                    "preview_path": null,
                    "thumbnail_path": null,
                    "enabled": "1",
                    "updated_at": "2019-10-11 15:52:11",
                    "created_at": "2019-10-11 15:52:11"
                }
            ]
      }
      ```

* **Error Response**

    * **Code:** 204 </br>
    * **No Content**
---
**Retrieve a custom template**
---

Show data of a exists custom template

* **URL**

    /api/v1/templates/:id

* **Method**

    GET

* **URL Params**

    | Name | Rule | Default | Comment |
    | --- | --- | --- | --- |
    | id | Required, integer | -- | The custom template id |

* **Data Params**

    None

* **Success Response**

    * **Code:** 200 </br>
    * **Content:**
      ```json
      {
        "data": {
            "id": 1,
            "vau_id": 26,
            "name": "Laidback Swingy Slides",
            "package": null,
            "version": null,
            "rotation": "square",
            "preview_path": null,
            "thumbnail_path": null,
            "enabled": "1",
            "updated_at": "2019-10-11 16:37:13",
            "created_at": "2019-10-11 16:37:13",
            "medias": [
                {
                    "id": 1,
                    "template_id": 1,
                    "placeholder": "logo_1",
                    "type": "image",
                    "color": null,
                    "default_value": null,
                    "preview_path": "/va_templates/15/medias/logo_03_post.png",
                    "thumbnail_path": null,
                    "position": 1,
                    "updated_at": "2019-10-11 16:37:13",
                    "created_at": "2019-10-11 16:37:13"
                },
                {
                    "id": 2,
                    "template_id": 1,
                    "placeholder": "item_1_image_1",
                    "type": "image",
                    "color": null,
                    "default_value": null,
                    "preview_path": "/va_templates/15/medias/es-sal-blue.png",
                    "thumbnail_path": null,
                    "position": 2,
                    "updated_at": "2019-10-11 16:37:13",
                    "created_at": "2019-10-11 16:37:13"
                },
                {
                    "id": 3,
                    "template_id": 1,
                    "placeholder": "item_1_title",
                    "type": "text",
                    "color": null,
                    "default_value": "ES\rSAL BLUE",
                    "preview_path": null,
                    "thumbnail_path": null,
                    "position": 3,
                    "updated_at": "2019-10-11 16:37:13",
                    "created_at": "2019-10-11 16:37:13"
                }
            ]
        }
        ```

* **Error Response**

    * **Code:** 404 </br>
    * **Content:**
        ```json
            {
                "message": "The requested template does not exists!"
            }
        ```

---

**Add new custom template**
---

Store new custom template & returns json data about the inserted row

* **URL**
    
    /api/v1/templates

* **METHOD**

    POST

* **URL Params**
    
    None

* **Data Params**

   The Json object represents the custom template with the required medias

   * **Attributes:**</br>

        | Name | Rule | Default | Comment |
        | --- | --- | --- | --- |
        | vau_id | Required, integer | -- | VAU Template id from the private/public account |
        | name | Required, string, length (min: 1, max: 100) | -- | Give to the template a name |
        | rotation | Required, string, in (square, portrait, landscape) | -- | The template video rotation |
        | medias | Required, array, size (min: 1) | -- | List of required medias for this template |
        | medias.*.placeholder | Required, string, length (min: 1) | -- | Placeholder the same as exported on the AEP file |
        | medias.*.type | Required, string, in (image, text) | image | Type of media |
        | medias.*.default_value | Optional, string | null | Default value |
        | medias.*.preview_path | Optional, string | null | Preview path |

   * **Example:**
```json
    {
        "vau_id": 26, 
        "name":	"Laidback Swingy Slides", 
        "rotation": "square",
        "medias": 
        [
            {
                "placeholder": "logo_1",
                "type": "image",
                "default_value": "https://vauvideo.com/assets/test_images/logo_01_post.png",
                "preview_path": "https://vauvideo.com/assets/test_images/logo_01_post.png"
            }
        ]
    }
```

* **Success Response**

    * **Code:** 200 </br>
    * **Content:** 
        ```json
        { 
            "template_id": 1, 
            "message": "The template 'Laidback Swingy Slides' has been added successfully." 
        }
        ```
* **Error Response**

    * **Code:** 400 </br>
    * **Content:** 
        ```json
        {
            "message": "The template 'Laidback Swingy Slides' is already exists!" 
        }
        ```

---

**Update a custom template**
---

Update a exists custom template and his medias

* **URL**
    
    /api/v1/templates/:id

* **METHOD**

    PUT

* **URL Params**
    
    | Name | Rule | Default | Comment |
    | --- | --- | --- | --- |
    | id | Required, integer | -- | The custom template id |

* **Data Params**

   The Json object represents the custom template with the required medias

   * **Attributes:**</br>

        | Name | Rule | Default | Comment |
        | --- | --- | --- | --- |
        | vau_id | Optional, integer | -- | VAU Template id from the private/public account |
        | name | Optional, string, length (min: 1, max: 100) | -- | Give to the template a name |
        | rotation | Optional, string, in (square, portrait, landscape) | -- | The template video rotation |
        | medias | Optional, array | -- | List of added medias for this template |
        | medias.*.placeholder | Optional, string, length (min: 1) | -- | Placeholder the same as exported on the AEP file |
        | medias.*.type | Optional, string, in (image, text) | image | Type of media |
        | medias.*.default_value | Optional, string | null | Default value |
        | medias.*.preview_path | Optional, string | null | Preview path |

   * **Example:**
```json
    {
        "id": 1,
        "medias": 
        [
            {
                "placeholder": "logo_2",
                "default_value": "https://vauvideo.com/assets/test_images/logo_02_post.png",
                "preview_path": "https://vauvideo.com/assets/test_images/logo_02_post.png"
            }
        ]
    }
```

* **Success Response**

    * **Code:** 200 </br>
    * **Content:** 
        ```json
        { 
            "template_id": 1, 
            "message": "The template 'Laidback Swingy Slides' has been updated successfully." 
        }
        ```
* **Error Response**

    * **Code:** 404 </br>
    * **Content:** 
        ```json
        {
            "message": "The requested template does not exists!" 
        }
        ```
        
    * **Code:** 400 </br>
    * **Content:** 
        ```json
        {
            "message": ":attribute validation failed!" 
        }
        ```

---
**Delete a custom template**
---

Delete a exists custom template row

* **URL**

    /api/v1/templates/:id

* **Method**

    DELETE

* **URL Params**

    | Name | Rule | Default | Comment |
    | --- | --- | --- | --- |
    | id | Required, integer | -- | The custom template id |

* **Data Params**

    None

* **Success Response**

    * **Code:** 200 </br>
    * **Content:**
      ```json
        {
            "message": "The Laidback Swingy Slides has been deleted successfully."
        }
      ```

* **Error Response**

    * **Code:** 404 </br>
    * **Content:**
        ```json
            {
                "message": "The requested template does not exists!"
            }
        ```
        
---
**Video automation Job status**
---

Get the status of a running video render job and download the exported video file if is done.

* **URL**

    /api/v1/status/:renderID/:action

* **Method**

    GET

* **URL Params**

    | Name | Rule | Default | Comment |
    | --- | --- | --- | --- |
    | renderID | Required, integer | -- | The video render job id |
    | action | optional, string | -- | Exec action if video render job done, the allowed now is download the file |

* **Data Params**

    None

* **Success Response**

    * **Code:** 200 </br>
    * **Content:**
      ```json
        {
            "data": {
                "job": 4396,
                "createdAt": "2019-10-10T17:16:05.091677",
                "status": "done",
                "progress": 100,
                "left": 0,
                "message": "Output files uploaded to storage.",
                "file": "https://out.vauvideo.com/6ZPYDAh1SBFifjSL/2aNixtjJSHqOFsVx.mp4",
                "finishedAt": "2019-10-10T17:18:29.332870"
            }
        }
      ```

* **Error Response**

    * **Code:** 404 </br>
    * **Content:**
        ```json
            {
                "message": "Job does not exists!"
            }
        ```
---
**Video automation User notification**
---

Update job status & Send notification to the user using email.

* **URL**

    /api/v1/notify/:renderID

* **Method**

    GET

* **URL Params**

    | Name | Rule | Default | Comment |
    | --- | --- | --- | --- |
    | renderID | Required, integer | -- | The video render job id |

* **Data Params**

    None

* **Success Response**

    * **Code:** 200 </br>
    * **Content:**
      ```json
        {
            "data": {
                "id": 5,
                "template_id": 124,
                "vau_job_id": 4395,
                "status": "done",
                "message": "Output files uploaded to storage.",
                "output_url": "https://out.vauvideo.com/6ZPYDAh1SBFifjSL/tELxeFJTLNQdyrtF.mp4",
                "progress": 100,
                "left_seconds": 0,
                "updated_at": "2019-10-10 17:03:32",
                "created_at": "2019-10-10 16:45:58",
                "finished_at": "2019-10-10 17:02:48"
            }
        }
      ```

* **Error Response**

    * **Code:** 404 </br>
    * **Content:**
        ```json
            {
                "message": "Job does not exists!"
            }
        ```
---
**Video automation callback URL by VAU API**
---

The callback method can called by the VAU API.

* **URL**

    /api/v1/notify/:renderID

* **Method**

    POST

* **URL Params**

    | Name | Rule | Default | Comment |
    | --- | --- | --- | --- |
    | renderID | Required, integer | -- | The video render job id |

* **Data Params**

    The data params will be submitted by the VAU API directly.

* **Success Response**

    * **Code:** 200 </br>
    * **Content:**
      ```json
        {
            "data": {
                "id": 5,
                "template_id": 124,
                "vau_job_id": 4395,
                "status": "done",
                "message": "Output files uploaded to storage.",
                "output_url": "https://out.vauvideo.com/6ZPYDAh1SBFifjSL/tELxeFJTLNQdyrtF.mp4",
                "progress": 100,
                "left_seconds": 0,
                "updated_at": "2019-10-10 17:03:32",
                "created_at": "2019-10-10 16:45:58",
                "finished_at": "2019-10-10 17:02:48"
            }
        }
      ```

* **Error Response**

    * **Code:** 404 </br>
    * **Content:**
        ```json
            {
                "message": "Job does not exists!"
            }
        ```
