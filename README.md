# Angular On PHP (AOP)

This is a comprehensive template for developing an application using Angular and CodeIgniter 4.2.
This template may be run on a standard LAMP (PHP 7.4 or highter) server without any special configuration; simply build and copy to the apache folder and enjoy. 

![](tests/autoupdate.png "Auto Update")

# Pre-Requisites Setup Windows
- install [nodejs](https://nodejs.org) 
- install [xampp](https://www.apachefriends.org/it/index.html) with php 7.4 highter on default folder (c:\xampp) 
- open xampp controls on apache config click to edit php.ini
- uncomment (remove ";") extension=intl and extension=gd (It is not necessary to run apache)

# Build Setup Common
- unpack AOP and open a terminal inside the folder just opened
- Do `node aop serve` and you'll can access debug angular to http://localhost:4200 and whole framework debug on http://localhost:8085

# All in one!
Aop comes with the tool aop, that you can start with: 
```
node aop command ...args
```
eg: 
```
node aop serve
```

Trick: do `node aop install` to call aop without node

eg: 
```
aop serve
```


to use the command as eg: aop build

|command| Description |
|-------|--------------------|
|serve|starts Angular and Codeigniter develop serve at http://localhost:4200 and http://localhost:8085|
|spark|starts Codeigniter spark utility|
|ng   | calls  Angular ng utility|
|build|  builds a complete plug and play package on build/ folder
|build:others|for all servers that do not support ".htaccess" this produces a complete plug-and-play package on the build folder, for security reasons, "public" is the only sub-folder you have to share|
|install|will install aop as command|

# Human Develop Requirements 😉
- basic Angular skills 
- basic PHP knowledge

# Build Requirements
- PHP 7.4 or highter
- node 18 or highter

# Destination Server Requirements
- Apache 2 or Nginx (it could works to others with php support on)
- PHP 7.4 or highter with intl and gd support

# Aop files

| File | Description |
|------------|-------------|
| aop_modules/versions | required in order to make codeigniter auto-update works |
| aop_modules/versions/composer.php | a Small composer init file |
| aop_modules/header.php | just an header for update.php |
| aop_modules/update.php | This script executes "Composer Update" straight from the browser during the initial http request to ensure that all framework dependencies and server prerequisites are met. It auto-disables itself after first execution, to re-enable it delete aop_modules/versions/*.txt|
| aop | Scripting tool that facilitates development using both framework|

# Misc
To edit code, I recommend using [visual studio code](https://code.visualstudio.com)
