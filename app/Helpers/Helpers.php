<?php

namespace App\Helpers;

use App\Models\SettingsModel;
use App\Models\User;
use Config;
use Exception;
use Illuminate\Support\Str;
use Throwable;
use GuzzleHttp\Client as GuzzleHttpClient;
class Helpers
{
  public static function appClasses()
  {
    $data = config('custom.custom');

    // default data array
    $DefaultData = [
      'myLayout' => 'vertical',
      'myTheme' => 'theme-default',
      'myStyle' => 'light',
      'myRTLSupport' => true,
      'myRTLMode' => true,
      'hasCustomizer' => true,
      'showDropdownOnHover' => true,
      'displayCustomizer' => true,
      'menuFixed' => true,
      'menuCollapsed' => false,
      'navbarFixed' => true,
      'footerFixed' => false,
      'menuFlipped' => false,
      // 'menuOffcanvas' => false,
      'customizerControls' => [
        'rtl',
        'style',
        'layoutType',
        'showDropdownOnHover',
        'layoutNavbarFixed',
        'layoutFooterFixed',
        'themes',
      ],
      //   'defaultLanguage'=>'en',
    ];

    // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
    $data = array_merge($DefaultData, $data);

    // All options available in the template
    $allOptions = [
      'myLayout' => ['vertical', 'horizontal', 'blank'],
      'menuCollapsed' => [true, false],
      'hasCustomizer' => [true, false],
      'showDropdownOnHover' => [true, false],
      'displayCustomizer' => [true, false],
      'myStyle' => ['light', 'dark'],
      'myTheme' => ['theme-default', 'theme-bordered', 'theme-semi-dark'],
      'myRTLSupport' => [true, false],
      'myRTLMode' => [true, false],
      'menuFixed' => [true, false],
      'navbarFixed' => [true, false],
      'footerFixed' => [true, false],
      'menuFlipped' => [true, false],
      // 'menuOffcanvas' => [true, false],
      'customizerControls' => [],
      // 'defaultLanguage'=>array('en'=>'en','fr'=>'fr','de'=>'de','pt'=>'pt'),
    ];

    //if myLayout value empty or not match with default options in custom.php config file then set a default value
    foreach ($allOptions as $key => $value) {
      if (array_key_exists($key, $DefaultData)) {
        if (gettype($DefaultData[$key]) === gettype($data[$key])) {
          // data key should be string
          if (is_string($data[$key])) {
            // data key should not be empty
            if (isset($data[$key]) && $data[$key] !== null) {
              // data key should not be exist inside allOptions array's sub array
              if (!array_key_exists($data[$key], $value)) {
                // ensure that passed value should be match with any of allOptions array value
                $result = array_search($data[$key], $value, 'strict');
                if (empty($result) && $result !== 0) {
                  $data[$key] = $DefaultData[$key];
                }
              }
            } else {
              // if data key not set or
              $data[$key] = $DefaultData[$key];
            }
          }
        } else {
          $data[$key] = $DefaultData[$key];
        }
      }
    }
    //layout classes
    $layoutClasses = [
      'layout' => $data['myLayout'],
      'theme' => $data['myTheme'],
      'style' => $data['myStyle'],
      'rtlSupport' => $data['myRTLSupport'],
      'rtlMode' => $data['myRTLMode'],
      'textDirection' => $data['myRTLMode'],
      'menuCollapsed' => $data['menuCollapsed'],
      'hasCustomizer' => $data['hasCustomizer'],
      'showDropdownOnHover' => $data['showDropdownOnHover'],
      'displayCustomizer' => $data['displayCustomizer'],
      'menuFixed' => $data['menuFixed'],
      'navbarFixed' => $data['navbarFixed'],
      'footerFixed' => $data['footerFixed'],
      'menuFlipped' => $data['menuFlipped'],
      // 'menuOffcanvas' => $data['menuOffcanvas'],
      'customizerControls' => $data['customizerControls'],
    ];

    // sidebar Collapsed
    if ($layoutClasses['menuCollapsed'] == true) {
      $layoutClasses['menuCollapsed'] = 'layout-menu-collapsed';
    }

    // Menu Fixed
    if ($layoutClasses['menuFixed'] == true) {
      $layoutClasses['menuFixed'] = 'layout-menu-fixed';
    }

    // Navbar Fixed
    if ($layoutClasses['navbarFixed'] == true) {
      $layoutClasses['navbarFixed'] = 'layout-navbar-fixed';
    }

    // Footer Fixed
    if ($layoutClasses['footerFixed'] == true) {
      $layoutClasses['footerFixed'] = 'layout-footer-fixed';
    }

    // Menu Flipped
    if ($layoutClasses['menuFlipped'] == true) {
      $layoutClasses['menuFlipped'] = 'layout-menu-flipped';
    }

    // Menu Offcanvas
    // if ($layoutClasses['menuOffcanvas'] == true) {
    //   $layoutClasses['menuOffcanvas'] = 'layout-menu-offcanvas';
    // }

    // RTL Supported template
    if ($layoutClasses['rtlSupport'] == true) {
      $layoutClasses['rtlSupport'] = '/rtl';
    }

    // RTL Layout/Mode
    if ($layoutClasses['rtlMode'] == true) {
      $layoutClasses['rtlMode'] = 'rtl';
      $layoutClasses['textDirection'] = 'rtl';
    } else {
      $layoutClasses['rtlMode'] = 'ltr';
      $layoutClasses['textDirection'] = 'ltr';
    }

    // Show DropdownOnHover for Horizontal Menu
    if ($layoutClasses['showDropdownOnHover'] == true) {
      $layoutClasses['showDropdownOnHover'] = 'true';
    } else {
      $layoutClasses['showDropdownOnHover'] = 'false';
    }

    // To hide/show display customizer UI, not js
    if ($layoutClasses['displayCustomizer'] == true) {
      $layoutClasses['displayCustomizer'] = 'true';
    } else {
      $layoutClasses['displayCustomizer'] = 'false';
    }

    return $layoutClasses;
  }

  public static function updatePageConfig($pageConfigs)
  {
    $demo = 'custom';
    if (isset($pageConfigs)) {
      if (count($pageConfigs) > 0) {
        foreach ($pageConfigs as $config => $val) {
          Config::set('custom.' . $demo . '.' . $config, $val);
        }
      }
    }
  }
  public static function authPermission($permisison_name)
  {
    $aPermission = (array) User::getPermissionsAttribute();
    if (!isset($aPermission[$permisison_name])) {
      return abort(403);
    }
    return true;
  }
  public static function checkPermission($permisison_name)
  {
    $aPermission = (array) User::getPermissionsAttribute();
    if (!isset($aPermission[$permisison_name])) {
      return false;
    }
    return true;
  }
  public static function sendNotif($sendWa, $sendEmail, $phone, $msg)
  {
    try {
      // kirim notif WA
      if ($sendWa && $phone != '') {
        $msgWa = SettingsModel::getData('wa.templatemessage') . $msg;
        // dd($msgWa);
        $client = new GuzzleHttpClient();
        $response = $client->request('POST', SettingsModel::getData('wa.url') . '/sendmessage', [
          'headers' => ['Accept' => 'application/json'],
          'json' => ['phoneNumber' => $phone, 'message' => $msgWa],
        ]);
        $response_json = json_decode($response->getBody()->getContents());
        if ($response_json->status == 'success') {
          return true;
        } else {
          return false;
        }
      }
      if ($sendEmail) {
        // kirim notif email
      }
    } catch (Throwable $e) {
      report($e);
      return false;
    }
    return false;
  }
  public static function checkStatusWa()
  {
    try {
      $client = new GuzzleHttpClient();
      $response = $client->request('GET', SettingsModel::getData('wa.url') . '/status', [
        'headers' => ['Accept' => 'application/json'],
      ]);
      $response_json = json_decode($response->getBody()->getContents());
    } catch (Throwable $e) {
      report($e);

      return false;
    }
    return $response_json;
  }
  // data Pegawai
  public static function getDataPegawai($nip)
  {
    $bearer = self::getTokenInternel();
    $client = new GuzzleHttpClient();
    $response = $client->request('GET', env('API_PEGAWAI') . 'api/hrms/pegawai/', [
      'headers' => [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $bearer,
      ],
      'query' => [
        'pegawai_nip' => $nip,
      ],
    ]);
    $response_json = json_decode($response->getBody()->getContents());
    return $response_json;
  }
  public static function getTokenInternel()
  {
    $user = User::find(1);
    $token = $user->createToken('siasn')->accessToken;
    return $token;
  }
  public static function getDataPegawaiSiasn($nip)
  {
    $token_apim = self::getTokenApim();
    $token_sso = self::getTokenSsoSiasn();
    if ($token_apim != '' && $token_sso) {
      $client = new GuzzleHttpClient();
      $response = $client->request('GET', 'https://apimws.bkn.go.id:8243/apisiasn/1.0/pns/data-utama/' . $nip, [
        'headers' => [
          'Accept' => 'application/json',
          'Auth' => 'bearer ' . $token_sso,
          'Authorization' => 'Bearer ' . $token_apim,
        ],
        'query' => [
          'pegawai_nip' => $nip,
        ],
      ]);
      $response_json = json_decode($response->getBody()->getContents());
      return $response_json;
    }
  }
  public static function getTokenApim()
  {
    $client = new GuzzleHttpClient();
    $response = $client->request('POST', 'https://apimws.bkn.go.id/oauth2/token', [
      'headers' => [
        'Content-Type' => 'application/x-www-form-urlencoded',
        'Authorization' => 'Basic ' . base64_encode('Zds_bXon3d4Fgw3BLo3cYhl2QfQa:KpDd4kaLhw36pQYS4b1DSvbu6UAa'),
        'Accept' => 'application/json',
      ],
      'form_params' => [
        'grant_type' => 'client_credentials',
      ],
    ]);
    $response_json = json_decode($response->getBody()->getContents());
    return $response_json->access_token ? $response_json->access_token : '';
  }
  public static function getTokenSsoSiasn()
  {
    $client = new GuzzleHttpClient();
    $response = $client->request(
      'POST',
      'https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token',
      [
        'headers' => [
          'Content-Type' => 'application/x-www-form-urlencoded',
          'Accept' => 'application/json',
        ],
        'form_params' => [
          'client_id' => 'sdmdikbudclient',
          'grant_type' => 'password',
          'username' => '199506102020121015',
          'password' => 'Rahasia123!',
        ],
      ]
    );
    $response_json = json_decode($response->getBody()->getContents());
    return $response_json->access_token ? $response_json->access_token : '';
  }

  public static function getSettingByName($name)
  {
    $data = SettingsModel::where('name', $name)->first();

    return $data;
  }
}
