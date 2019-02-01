# Documents Manager
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/3118ebe6bb4647df99675e83a9f56de2)](https://www.codacy.com/app/laravel-enso/DocumentsManager?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/DocumentsManager&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85587885/shield?branch=master)](https://styleci.io/repos/85587885)
[![License](https://poser.pugx.org/laravel-enso/datatable/license)](https://packagist.org/packages/laravel-enso/datatable)
[![Total Downloads](https://poser.pugx.org/laravel-enso/documentsmanager/downloads)](https://packagist.org/packages/laravel-enso/documentsmanager)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/documentsmanager/version)](https://packagist.org/packages/laravel-enso/documentsmanager)

Documents Manager for [Laravel Enso](https://github.com/laravel-enso/Enso).

[![Watch the demo](https://laravel-enso.github.io/documentsmanager/screenshots/bulma_019_thumb.png)](https://laravel-enso.github.io/documentsmanager/videos/bulma_demo_01.webm)

<sup>click on the photo to view a short demo in compatible browsers</sup>

### Features

- permits the management (upload, download, delete, show) of documents in the application
- can attach documents to any other model
- comes with its own VueJS components
- uses [FileManager](https://github.com/laravel-enso/FileManager) for file operations
- uses the [ImageTransformer](https://github.com/laravel-enso/ImageTransformer) package for optimizing 
the uploaded image files
- security policies are used to enforce proper user authorization
- comes with a `Documentable` trait that can be quickly added to the model you want to give this functionality to
- offers various configuration options, including the option to delete all attached documents 
to a Documentable entity, when it gets deleted 

### Configuration & Usage

Be sure to check out the full documentation for this package available at [docs.laravel-enso.com](https://docs.laravel-enso.com/packages/documents-manager.html)

### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.