
# TOWISE PHP API
Towise assists you to detect human faces and bodies with using the latest and reliable technology.

## Getting Started
### Prerequisites 
```
php 5.3+
composer 1.8+
```
### Installing
To install the package

```sh
composer install towise 
```
To import your project
```php
const Towise = require('towise');
```
### Using Towise
You must enter appKey and appId

For Example:
```php

$image = "https://wallpapershome.com/images/pages/pic_v/14562.jpg";
$towise = new Towise("type your appid", "type your appkey");

//for detection the face  on image
echo $towise->faceDetect($image); // you can also type $image_base64

//for detection the body on image
echo $towise->bodyDetect($image); // you can also type $image_base64

//for detection the emotion of person on image
echo $towise->emotionDetect($image); // you can also type $image_base64

// compare the photo with the users registered in the system and recognize the face
echo $towise->faceComparing($image); // you can also type $image_base64

// returns all persons in system
echo $towise->getAllPerson();

//returns person by id
echo $towise->getPerson("person id");

//add new person to system
echo $towise->addPerson("person name");

//remove the person from system
echo $towise->removePerson("person id");

//returns all faces of persons by person id
echo $towise->getAllFace("person id");

//return face of person by face id
echo $towise->getFace("face id");

//add new image to person by person id. Saves the photo to the system, if you pass 3. argument as yes
echo $towise->addFace($image,"person id","yes/no");// you can also type $image_base64. At the same time you should yes or no as 3. arguments

//remove face of person by face id
echo $towise->removeFace("face id");
```

## Versioning
For the versions available, see the https://github.com/argedor/TowisePHPAPI/tags

## Authors
* **Harun Keleşoğlu** - *Developer* - [Github](https://github.com/harunkelesoglu)
See also the list of [contributers](https://github.com/argedor/TowisePHPAPI/graphs/contributors)

## License

This project is licensed under the MIT License - see the [LICENSE.txt](LICENSE.txt) file for details