<?php

namespace LaravelEnso\Core\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

class IdaciController extends Controller
{
  use AuthorizesRequests;

  public function getForPostCode($postCode)
  {
    $client = new Client();

    $options = [
      'form_params' => [
        "postcodes" => $postCode,
      ],
    ];
    $response = $client->post("http://imd-by-postcode.opendatacommunities.org/deprivation/download", $options);

    $body = $response->getBody()->getContents();
    $rows = explode("\n", $body);
    $data = array_combine( explode(",", $rows[0]), explode( ",", $rows[1]) );

    return [
      'response' => $data
    ];
  }
}
