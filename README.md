# Insee

A PHP client library for accessing INSEE data for https://api.insee.fr/

# Installation

This page contains information about installing the Library for PHP.

### Requirements

- PHP version 7.0.0 or greater

### Obtaining the client library

There are two options for obtaining the files for the client library.

#### Using Composer

You can install the library by adding it as a dependency to your composer.json.

```json
  "require": {
    "davaxi/insee": "^1.0"
  }
```

#### Cloning from GitHub

The library is available on [GitHub](https://github.com/davaxi/insee). You can clone it into a local repository with the git clone command.

```sh
git clone https://github.com/davaxi/insee.git
```

### What to do with the files

After obtaining the files, ensure they are available to your code. If you're using Composer, this is handled for you automatically. If not, you will need to add the `autoload.php` file inside the client library.

```php
require '/path/to/insee/folder/autoload.php';
```

## Usage

Create account on https://api.insee.fr/ and create application. Get clientId and clientSecret and subscribe API to your application.

Example: 

```php
<?php

require '/path/to/insee/folder/autoload.php';

$client = new Davaxi\Insee();
$client->setClientId('YOUR CLIENT ID');
$client->setClientSecret('YOUR CLIENT SECERT');
$client->authenticate();

$options = [
    'q' => 'SAS',
    'date' => '2020-01-20',
    // ...
];
// Equivalent
$options = new \Davaxi\Insee\Options();
$options->setQuery('SAS')->setDate('2020-01-20'); // ...

$service = new \Davaxi\Insee\Service\UniteLegale($client);
$response = $service->search($options);
var_dump($response);

/*
[
  "header": { ...  },
  "unitesLegales": [ ... ],
  "facettes": [ ... ],
];
*/

```

## Documenation of API

Use directly https://api.insee.f documentation for all request and response. 