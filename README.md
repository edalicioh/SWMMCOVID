
<p align="center"><a href="http://www.camboriu.ifc.edu.br/" target="_blank"><img src="./public/img/logoIFC.png" width="400"></a></p>



# Sistema web municipal de monitoramento de COVID-19 - SWMMCOVID


## **Sobre**


<p> Sistema desenvolvido por alunos e professores do IFC campus Camboriú com objetivo de MONITORAR e RASTREAR casos de Covid-19 a nível municipal diagnosticando a presença e evolução por bairros da pandemia. Esta pode ser uma ferramenta de gestão pública para tomada de decisões na área da saúde, educação, assistência social, etc.
</p>


## **Tecnologias utilizadas neste sistema**

* PHP 
* Mysql
* Framework Laravel
* Javascript
* Leaflet
* OpenStreetMap
* CSS/SCSS
  
## **Requirementos**

* PHP = ^7.2.5
* Composer = ^1.10
* Node = ^12  
* Mysql = ^8.0
  
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

<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licença Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />Este trabalho está licenciado com uma Licença <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons - Atribuição-NãoComercial-CompartilhaIgual 4.0 Internacional</a>.

---

<p align="center"><a href="http://www.camboriu.ifc.edu.br/autoprotecao-social/" target="_blank"><img src="./public/img/banner-social.png"></a></p>
