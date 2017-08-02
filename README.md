# Strapdown.php

A proof-of-concept for replacing blocks of Markdown in HTML with its converted
HTML, inspired by [Strapdown.js](https://github.com/arturadib/strapdown). It
isn’t strictly limited to Markdown, but only comes with a Markdown converter
for now.

It works by looking for `xmp` elements that have a custom attribute
`data-language`. If this attribute matches the name for a converter, that
converter is asked to convert the contents of the `xmp` element. The results of
this conversion will replace the `xmp` element.

The attribute is called `data-language` as it is recommended to use MIME types
for format identification. This will allow several formats and several
converters to work on the same HTML file.

## Run PoC

**Note:** Because this is a proof-of-concept treat none of the following as
permanent.

1. Clone this repository:

   ```
   git clone https://github.com/Zegnat/strapdown.php.git
   ```

2. Move into the newly created folder:

   ```
   cd strapdown.php
   ```

3. Have [Composer](https://getcomposer.org/) install the dependencies:

   ```
   composer install --no-dev
   ```

4. (Optional) Grab a demo file to run Strapdown.php against:

   ```
   wget https://gist.githubusercontent.com/Zegnat/c02190dbb7af24242a9e7bc9403eb5b9/raw/11610c07a1da5581999f3b55814279894d3cd83b/sample.html
   ```

5. Run it:

   ```
   bin/strapdown sample.html > out.html
   ```

## Licence

This project is made available under the BSD Zero Clause License (0BSD). Please
see [LICENSE](LICENSE) for the exact terms.

In short it means you may use any of this code, for any purpose, and are free
to either credit me or not. I would appreciate the credit though!
