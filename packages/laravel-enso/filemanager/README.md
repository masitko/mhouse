# File Manager
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/6e342eff10f24db5b89be5fe203e424d)](https://www.codacy.com/app/laravel-enso/FileManager?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/FileManager&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85492361/shield?branch=master)](https://styleci.io/repos/85492361)
[![License](https://poser.pugx.org/laravel-enso/datatable/license)](https://packagist.org/packages/laravel-enso/datatable)
[![Total Downloads](https://poser.pugx.org/laravel-enso/filemanager/downloads)](https://packagist.org/packages/laravel-enso/filemanager)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/filemanager/version)](https://packagist.org/packages/laravel-enso/filemanager)

File manager dependency for [Laravel Enso](https://github.com/laravel-enso/Enso).


[![Watch the demo](https://laravel-enso.github.io/filemanager/screenshots/bulma_001_thumb.png)](https://laravel-enso.github.io/filemanager/videos/bulma_filemanager.mp4)


<sup>click on the photo to view a short demo in compatible browsers</sup>

### Features

- provides a generic approach when working with files through using a `File` model
- package comes with a `HasFile` trait that can be added to models who work with files
- has utility classes for the upload, download, inline-opening and deletion of files
- on upload, performs validation of the file and checks the extension and the mime type
- handles the optimization and resize for the supported image file types  
- for upload and deletion, the changes are committed only if the filesystem operation was successful
- works with a `FileUploader` VueJS component that handles the selection of files and POSTs them to the specified route
- uses a policy to restrict access/changes to files that don't belong to the respective user
- provides a unified interface where you can view all the files you are working with, that you have access to, as well as search and filter them
- the types of files that are visible in the interfaces are configurable

### Configuration & Usage

Be sure to check out the full documentation for this package available at [docs.laravel-enso.com](https://docs.laravel-enso.com/packages/file-manager.html)

### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
