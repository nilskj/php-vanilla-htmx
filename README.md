## PHP no framework HTMX example

This is a simple example of using HTMX with PHP and no framework. It uses the [HTMX](https://htmx.org/) library to make AJAX requests and update the page with HTML over the wire. It has some basic error handling and exception handling.
We can also parse the HX-request header and render content without template. See `register_shutdown_function()`. In the /about page I also included an example of how one can work with a SQLite database.

I'm running this locally on my mac by using https://www.mamp.info/en/mamp/mac/ with a nginx controller that is routing like so:
```nginx
	server {
		listen 8999;
		server_name simple.local;

		root  "/Applications/MAMP/htdocs/project";

		location / {
			try_files $uri /app/index.php?$query_string;
		}

		location ~ ^/(public/)?.*\.(css|js)$ {
			try_files $uri =404;
			autoindex on;
		}

		location ~ \.php$ {
			try_files        $uri =404;
			fastcgi_pass     unix:/Applications/MAMP/Library/logs/fastcgi/nginxFastCGI.sock;
			fastcgi_param    SCRIPT_FILENAME $document_root$fastcgi_script_name;
			include          fastcgi_params;
		}

		location ~ /\. {
			deny all;
		}
	}
```
Apache/httpd or other web servers should also work. Have fun!