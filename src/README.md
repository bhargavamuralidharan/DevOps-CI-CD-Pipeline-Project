# DevOps-CI-CD-Pipeline-Project
### Testing on Localhost
Running this app locally requires XAMPP (or MAMP for MacOS) and configuration of a virtual host. To configure it to work with this app, please do the following:
1. Clone this repository inside your `htdocs` folder in XAMPP
2. Navigate to `C:/xampp/apache/conf/extra/` (or where your XAMPP folder is installed) and open the `httpd-vhosts.conf` file using your text editor
3. Add the following to the file:
  ```
  <VirtualHost www.devops-ci.loc:80>
    DocumentRoot "C:\xampp\htdocs\devops-ci"
    ServerName devops-ci.loc
    ServerAlias www.devops-ci.loc
    <Directory "C:\xampp\htdocs\devops-ci">
    Order allow,deny
    Allow from all
    </Directory>
  </VirtualHost>
  ```
  (replace the DocumentRoot and Directory values with the actual path to the folder on your computer)
  
4. Go to `C:/windows/system32/drivers/etc` and open the `hosts` file using a text editor
5. Add the following:
  ```
  127.0.0.1 www.devops-ci.loc
  127.0.0.1 devops-ci.loc
  ```
6. Restart the apache module in XAMPP (if you already had it running). Otherwise, start it
7. Open PHPMYADMIN (go to `localhost/phpmyadmin`), create a new DB called `devops-ci`
8. Click the `Import` tab at the top of the page and upload the `devops-ci.sql` file from this repository
9. Go to `http://www.devops-ci.loc/` to confirm that the configurations above are working
