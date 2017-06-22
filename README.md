File Reference Link Querystring Version Php Script
=================

A simple php script that will version reference and link calls from specific file and append last commitid as version. Credits to [Neil Male's Robo Php File Versioning](https://github.com/neilmaledev/robo-php-boilerplate)

Example:
```html
<script src="scripts/app.js?ver=f7d81e30"></script>
```

References: 

[What does appending v-1 to css and javascript urls do?](https://stackoverflow.com/questions/3466989/what-does-appending-v-1-to-css-and-javascript-urls-in-link-and-script-tags-do)

[How to append timestamp to a script file?](https://stackoverflow.com/questions/11467873/how-to-append-timestamp-to-the-java-script-file-in-script-tag-url-to-avoid-cac)

[What is a for in the src attribute of a html script?](https://stackoverflow.com/questions/4220155/what-is-a-for-in-the-src-attribute-of-a-html-script-tag)

Usage
---------
Place the file ```version``` in your project folder, then specify the files to update in the script
```php
$fileToUpdate = [
		'public/scripts/route.js',
		'app/views/index/index.volt'
];
```
These files will be scanned for script changes base on the git diff and will 
automatically update script tags with the appended latest commit hash as file version like the example above.

On your browser or hit the file, or on your cli ```php version.php```
