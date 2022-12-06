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
|serve|This begins the development server for Angular and Codeigniter at http://localhost:4200 and http://localhost:8085. You might alternatively use a separate module to serve as a comment, for instance: emergency aop serve or aop serve in the event of an emergency| 
|spark|This launches the Codeigniter spark utility|
|composer|This launches the Composer PHP tool.|
|ng   | This invokes the Angular ng utility, and you may also begin using it with a different module, such as aop ng emergency... or aop emergency ng ... for example.|
|npm  | This invokes the Angular npm utility, and you may alternatively start using it with a different module, such as aop npm emergency... or aop emergency npm... for example.|
|npx  | This invokes the Angular npx utility, and you may also start using it with a different module, such as aop npx emergency... or aop emergency npx... for example.|
|ma  | This creates an Angular module that will load the method aopRender inside of the controller.|
|mc  | This will convert an existing Angular project inside of asrc to a module, which can then be loaded into controller using the method aopRender.|
|build| This generates a full plug-and-play package in the build folder; but, if you choose, you may generate only one module instead of all of them. For instance: aop build emergency|
|build:others|This generates a complete plug-and-play package on the build folder for all servers that do not support ".htaccess." For reasons of safety, the "public" subfolder is the only one that must be shared; alternatively, you can build just one module rather than all of them. Here is an example of what this might look like: aop build emergency|
|copy|This will copy your build to a remote ftp server or a folder using the following syntax: ftp: /user:pass@host[:path]|
|install|This will install aop as a command inside the system.|


Options:
|   Option   | Alternative | Description         |
| :---------  | :-------------- | :--------------------- |
|...........................|..............................|.............................................................................................|
| *-c path*   | *--copy=path* |Following the completion of the build, this command will transfer the build to a specified folder or an external FTP server using the syntax ftp:/user:pass@host[ :path].|
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
