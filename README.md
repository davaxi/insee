# Insee

A PHP client library for accessing INSEE data for [https://api.insee.fr/](https://api.insee.fr/)

[![Build Status](https://travis-ci.org/davaxi/insee.svg)](https://travis-ci.org/davaxi/insee)
[![Latest Stable Version](https://poser.pugx.org/davaxi/insee/v/stable)](https://packagist.org/packages/davaxi/insee) 
[![Total Downloads](https://poser.pugx.org/davaxi/insee/downloads)](https://packagist.org/packages/davaxi/insee) 
[![Latest Unstable Version](https://poser.pugx.org/davaxi/insee/v/unstable)](https://packagist.org/packages/davaxi/insee) 
[![License](https://poser.pugx.org/davaxi/insee/license)](https://packagist.org/packages/davaxi/insee)
[![Maintainability](https://api.codeclimate.com/v1/badges/347466fbd9add873f19d/maintainability)](https://codeclimate.com/github/davaxi/insee/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/347466fbd9add873f19d/test_coverage)](https://codeclimate.com/github/davaxi/insee/test_coverage)

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

Use directly [https://api.insee.fr/](https://api.insee.fr/) documentation for all request and response. 