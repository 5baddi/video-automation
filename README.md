# Social Video Automation
### An app to auto generate videos from content of V12 Software plat-form using the [VAU API](https://vauvideo.com)
[Developed by Mohamed BADDI](https://github.com/5baddi)

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
                "default_value": "https://vauvideo.com/assets/test_images/logo_03_post.png",
                "preview_path": "https://vauvideo.com/assets/test_images/logo_03_post.png"
            }
        ]
    }
```

* **Success Response**

    * **Code:** 200 </br>
      **Content:** 
        ```json
        { 
            "template_id": 1, 
            "message": "The template 'Laidback Swingy Slides' has been added successfully." 
        }
        ```
* **Error Response**

    * **Code:** 400 </br>
      **Content:** 
        ```json
        {
            "message": "The template 'Laidback Swingy Slides' is already exists!" 
        }
        ```

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
      **Content:**
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
      **No Content**

