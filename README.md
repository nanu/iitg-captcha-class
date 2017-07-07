# iitg-captcha-class
This is a PHP Class implementation for generating the CAPTCHA image/code for use in login form/process.

Dependencies: The PHP GD library is required to be pre-installed on the web server (php-gd).

Note: "https" should be used for implementing the login/secure URLs when-ever you send out sensitive information across the network (like the username and password)

Check-out the "example-usage" folder, which contains a sample use-case of this class
example-usage/<br />
├── classes<br />
│   └── iitg-captcha-class.php #IITG CAPTCHA Class<br />
├── config.php #Global config file<br />
└── captcha-image.php #The PHP file generating the CAPTCHA image
