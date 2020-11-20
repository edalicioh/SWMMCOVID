
<p align="center"><a href="http://www.camboriu.ifc.edu.br/" target="_blank"><img src="./public/img/logoIFC.png" width="400"></a></p>



# Sistema web de controle de **COVID-19**


## **Sobre**


<p> O sistema desenvolvido pelo IFC campus Camboriú tem por finalidade  obter o controle com mais eficácia sobre a Pandemia do Covid-19. Diante da situação completamente desconhecida que nos encontramos criou-se a necessidade desta ferramenta.</p>


## **Tecnologias utilizadas neste sistema**

* PHP 
* Mysql
* Framework Laravel
* Javascript
* Leaflet
* OpenStreetMap
* CSS/SCSS
  
## **Requirementos**

* PHP >= 3.5+  (INFORMAR A VERSÕES)
* Composer >= 3.5+
* Node >= 3.5+  
* Mysql >= X.x+
* Filezilla instalado (ACHO QUE NÃO PRECISA COLOCAR)
  
## **Instalação**

1. Para utilização deste sistema
	- Deve posuir um servidor PHP
	- Banco de Dados Mysql ou PostgresSQL
  
2. Baixar ou Clonar este projeto

  
    [Clique para Baixar](https://github.com/edalicioh/covid-serve/archive/master.zip)

    **ou**
    
    ```shell
    git clone https://github.com/edalicioh/covid-serve.git
    ```

3. Instalar no computador local
    - Para computadores com linux
    ```shell
    sudo ./install.sh
    ```
4. Iniciar o banco de dados


    - abrir o arquivo **.env** e editar os seguintes dados
  
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    - após editar executar 
    
    ```
    sudo ./banco.sh
    ```



## **Licença**

software de código aberto licenciado sob a licença MIT.

<p align="center"><a href="http://www.camboriu.ifc.edu.br/autoprotecao-social/" target="_blank"><img src="./public/img/banner-social.png"></a></p>
