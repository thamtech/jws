yii2-jws
========

An extension to manage signed JWS tokens

This library interfaces with
[namshi/jose](http://github.com/namshi/jose) to generate signed
[JWS](https://tools.ietf.org/html/rfc7515) tokens.

For license information check the [LICENSE](LICENSE.md)-file.

Installation
------------

The preferred way to install this extensions is through [composer](http://getcomposer.org/download/).

Either run
```
php composer.phar require --prefer-dist thamtech/yii2-jws
```
or add
```
"thamtech/yii2-jws": "*"
```
to the `require` section of your `composer.json` file.

Integration
-----------

1. [Generate a kepair using OpenSSL](https://en.wikibooks.org/wiki/Cryptography/Generate_a_keypair_using_OpenSSL)
   and store the keys in public.pem and private.pem.

2. Add the JwsManager application component in your site configuration:

    ```php
    return [
      'components' => [
        'jwsManager' => [
          'class' => 'thamtech\jws\components\JwsManager',
          'pubkey' => '@app/config/keys/jws/public.pem',
          'pvtkey' => '@app/config/keys/jws/private.pem',
          
          // The settings below are optional. Defaults will be used if not set here.
          //'encoder' => 'Namshi\JOSE\Base64\Base64UrlSafeEncoder',
          //'refreshExp' => '24 hours',
          //'exp' => '1 hour',
          //'alg' => 'RS256',
          //'jwsClass' => 'Namshi\JOSE\SimpleJWS',
        ],
      ]
    ]
    ```

Usage
-----

Generate a new token:
```php
$payload = [
  "user_id": 23,
  "foo": "bar",
];
$tokenString = Yii::$app->jwsManager->newToken($payload);
```

Verify that this string is a token that we signed:
```php
$token = Yii::$app->jwsManager->load($tokenString);
$result = Yii::$app->jwsManager->verify($token);
```

Verify that this string is a token that we signed AND (if it is an instance
of `\Namshi\JOSE\SimpleJWS` wih an expiration) that it is not expired:
```php
$token = Yii::$app->jwsManager->load($tokenString);
$result = Yii::$app->jwsManager->isValid($token);
```

See Also
--------

* [cranetm/yii2-json-rpc-2.0](http://github.com/cranetm/yii2-json-rpc-2.0) - Yii 2
  extension that helps turn your Controllers into JSON RPC 2.0 APIs.
  
* [namshi/jose](http://github.com/namshi/jose) - PHP implementation of the
  JWS (JSON Web Signature) specification.
  
* [JSON Web Signature (JWS)](https://tools.ietf.org/html/rfc7515) - JWS specifications

* [thamtech/yii2-jsonrpc-jwsauth](http://github.com/thamtech/yii2-jsonrpc-jwsauth)
