# Simple PHP image stealing script#

This script is intended to grab images from Internets. But it still can handle other types of files (no limitations). 
You can pass an image url _or_ upload file directly.

## Requirements

* Any PHP-enabled web-server (I use Lighttpd with php-cgi)
* Internet connection
* Enough space on disk

## Installation
* Clone the repo
* Check the config section in index.php, don't forget to change password
* Set location of your upload dir (absolute path on server)
* Set appropriate relative url to images

### Examples
Your domain: example.com
Local dir /var/www/imagegrab/uploads
Relative URL: /imagegrab/uploads
So UI will be here http://example.com/imagegrab
Images here: http://example.com/imagegrab/uploads/your_image_Name_timestamp.jpg (or whatever file will be called)

## Usage

Open http://example.com/imagegrab in browser, humble UI will show up. Then, select grab mode (URL or direct upload), enter your password (u don't want an open image hosting, don't ya ?) and press "Process" button. The image will be uploaded (or downloaded) with and unique timestamp in name.

Below the UI link will appear, or if you are not lucky - not so informative error message.
You can copy link and use it (post on forums, etc).

## Trobleshooting

1. Check your PHP setup is working
2. Check upload dir for permissions - for Debian it should be writable/owned by www-data.

## Purpose
This script was made for personal goals, e.g. capturing images for linking in TiddlyWiki. It is not intented for production use and one should add more security to app itself and more glamour to UI.

Have fun.