<?php
namespace towise\api;
class Towise
{
    private $baseUrl = "https://api.towise.io";
    private $faceDetect = "/detect/face";
    private $bodyDetect = "/detect/person";
    private $emotionDetect = "/detect/emotion";
    private $faceCompare = "/recognize/face";
    private $persons = "/persons/";
    private $faces = "/faces/";
    private $appId;
    private $appKey;

    function Towise($appId, $appKey)
    {
        $this->appId = $appId;
        $this->appKey = $appKey;
    }

    function createRequest($url, $method, $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "appid:" . $this->appId,
                "appkey:" . $this->appKey,
                "Accept: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

    private function checkImage($image)
    {
        $imageType = "";
        if (preg_match("/(data:image)/", $image)) {
            $imageType = "image_base64=" . $image;
        } else {
            $imageType = "image_url=" . $image;
        }
        return $imageType;
    }

    function faceDetect($image)
    {
        $url = $this->baseUrl . $this->faceDetect;
        $data = $this->checkImage($image);
        return $this->createRequest($url, 'POST', $data);
    }
    function bodyDetect($image)
    {
        $url = $this->baseUrl . $this->bodyDetect;
        $data = $this->checkImage($image);
        return $this->createRequest($url, 'POST', $data);
    }
    function emotionDetect($image)
    {
        $url = $this->baseUrl . $this->emotionDetect;
        $data = $this->checkImage($image);
        return $this->createRequest($url, 'POST', $data);
    }
    function faceComparing($image)
    {
        $url = $this->baseUrl . $this->faceCompare;
        $data = $this->checkImage($image);
        return $this->createRequest($url, 'POST', $data);
    }
    function getAllPerson()
    {
        $url = $this->baseUrl . $this->persons;
        return $this->createRequest($url, 'GET', null);
    }
    function getPerson($personId)
    {
        $url = $this->baseUrl . $this->persons . "?person_id=" . $personId;
        return $this->createRequest($url, 'GET', null);
    }
    function addPerson($name)
    {
        $url = $this->baseUrl . $this->persons;
        $data = "name=" . $name;
        return $this->createRequest($url, 'POST', $data);
    }
    function removePerson($personId)
    {
        $url = $this->baseUrl . $this->persons;
        $data = "person_id=" . $personId;
        return $this->createRequest($url, 'DELETE', $data);
    }
    function getAllFace($personId)
    {
        $url = $this->baseUrl . $this->faces . "?person_id=" . $personId;
        return $this->createRequest($url, 'GET', null);
    }
    function getFace($faceId)
    {
        $url = $this->baseUrl . $this->faces . "?face_id=" . $faceId;
        return $this->createRequest($url, 'GET', null);
    }
    function addFace($image, $personId, $save)
    {
        $url = $this->baseUrl . $this->faces;
        $data = "person_id={$personId}&{$this->checkImage($image)}&save_image={$save}";
        return $this->createRequest($url, 'POST', $data);
    }
    function removeFace($faceId)
    {
        $url = $this->baseUrl . $this->faces;
        $data = "face_id=" . $faceId;
        return $this->createRequest($url, 'DELETE', $data);
    }
}

