##Gerenciamento de Projetos com laravel 5.1 e AngularJs 1.5

##### Instalando a aplicação

```sh   
    - git clone https://github.com/luisconcha/lacc_project.git
    - composer install
    - bower install
    - criar arquivo .env e gerar a chave ( php artisan key:generate)
    - Criar BD
    - Alterar credenciais do bd (user, password, host, database)  no arquivo .env
    - Permissão de escrita para a pasta storage/logs e storage/framework
    - npm install
    - gulp watch-dev 
```
##### Criar host e virtualhost 
```sh   
      /etc/host:
      127.0.0.1   project.dev
```

```sh   
        /etc/httpd/conf.d/siga.conf
        <VirtualHost *:80>
            ServerAdmin project.dev
            ServerName project.dev
            ServerAlias www.project.dev
            DocumentRoot /var/www/html/lacc_project/public
                  <Directory "/var/www/html/lacc_project/public">
                          DirectoryIndex index.php
                          AllowOverride All
                          Order allow,deny
                          Allow from all
                  </Directory>
        </VirtualHost>
```

######OBS: Caso mude o nome do host ou rodar php artisan serve, atualizar o valor do provider baseUrl do arquivo app.js 

##### Acessar à aplicação 
   
> [http://project.dev/#/login](http://project.dev/#/login)
> email: luvett11@gmail.com
> password: 123456


#####Version
> 1.0.

#####Developer:
> Luis Alberto Concha Curay - luisconchacuray@gmail.com