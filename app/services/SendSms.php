<?php


namespace App\services;


class SendSms
{
    private $url = "https://api.kavenegar.com/v1/6F465A5A7A754732615573674A4C6449564F44465875393730556F4362644F446453344974457657515A383D/verify/lookup.json";

    public function otp($data)
    {
        $client = (new \GuzzleHttp\Client())->post($this->url, [
            'form_params' => [
                'receptor' => $data['mobile'],
                'token' => $data['code'],
                'template' => 'verify',
            ]
        ]);

        return $client->getBody();
    }
}