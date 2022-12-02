# Angular On PHP (AOP)

This is a comprehensive modular template for developing an application using Angular and CodeIgniter 4.2.
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

|Command| Description |
|-------|--------------------|
|serve|starts Angular and Codeigniter develop serve at http://localhost:4200 and http://localhost:8085 you can serve also a different module as comment for example: aop serve emergency| 
|spark|starts Codeigniter spark utility|
|ng   | calls  Angular ng utility, you can start also use it to a different module for example: aop ng emergency ...args|
|npm  | calls  Angular ng utility, you can start also use it to a different module for example: aop npm emergency ...args|
|npx  | calls  Angular ng utility, you can start also use it to a different module for example: aop npx emergency ...args|
|ma  | make an Angular module to load with utility aopRender inside controller|
|mc  | convert an existing Angular project inside asrc to module to load with utility aopRender inside controller|
|build| builds a complete plug and play package on build/ folder, you can build also 1 module instead all them, for example: aop build emergency|
|build:others|for all servers that do not support ".htaccess" this produces a complete plug-and-play package on the build folder, for security reasons, "public" is the only sub-folder you have to share, you can build also 1 module instead all them, for example: aop build emergency|
|copy|copy your build to a folder or remote ftp server with syntax ftp://user:pass@host[ :path]|
|install|will install aop as command|


Options:
|   Option   | Alternative | Description         |
| :---------  | :-------------- | :--------------------- |
|...........................|..............................|.............................................................................................|
| *-c path*   | *--copy=path* |after build command will copy the build to a folder or remote ftp server with syntax ftp://user:pass@host[ :path]|
| *-u username* | *--username=user* |ftp username.|
| *-p password* | *--password=pass* |ftp password.|
| *-fp port*  | *--ftp-port=port* |change the default ftp port.|

 
 

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
| aopm/versions | required in order to make codeigniter auto-update works |
| aopm/versions/composer.php | a Small composer init file |
| aopm/header.php | just an header for update.php |
| aopm/update.php | This script executes "Composer Update" straight from the browser during the initial http request to ensure that all framework dependencies and server prerequisites are met. It auto-disables itself after first execution, to re-enable it delete aopm/versions/*.txt|
| aop | Scripting tool that facilitates development using both framework|

# Misc
To edit code, I recommend using [visual studio code](https://code.visualstudio.com)
